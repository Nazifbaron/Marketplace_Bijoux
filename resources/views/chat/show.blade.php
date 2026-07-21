@extends('layouts.artisan')

@section('title', 'Conversation')

@section('extra-styles')
.chat-window { display: flex; flex-direction: column; height: calc(100vh - 73px); }
.messages-area { flex: 1; overflow-y: auto; padding: 24px; display: flex; flex-direction: column; gap: 4px; }
.msg-row { display: flex; margin-bottom: 4px; }
.msg-row.mine { justify-content: flex-end; }
.msg-bubble { max-width: 65%; padding: 10px 16px; font-size: 14px; line-height: 1.4; }
.msg-row.mine .msg-bubble { background: #000000; color: #fff; border-radius: 12px 12px 2px 12px; }
.msg-row.theirs .msg-bubble { background: #efeeeb; color: #1a1c1a; border-radius: 12px 12px 12px 2px; }
.msg-time { font-size: 10px; color: #747878; margin-top: 2px; padding: 0 4px; }
.msg-row.mine .msg-time { text-align: right; }
@endsection

@section('content')

@php
$isVendor = isset($vendorApplication) ? false : null; // sera recalculé en JS via auth id
$currentUserId = auth()->id();
$otherParty = $conversation->buyer_id === $currentUserId
? ($conversation->vendor->shop_name ?? $conversation->vendor->full_name)
: $conversation->buyer->name;
@endphp

<header class="sticky top-0 z-40 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 px-8 py-4 flex items-center gap-4">
    <a href="{{ route('chat.index') }}" class="text-on-surface-variant hover:text-primary">
        <span class="material-symbols-outlined">arrow_back</span>
    </a>
    <div class="w-9 h-9 bg-primary flex items-center justify-center flex-shrink-0">
        <span class="text-white text-xs font-bold uppercase">{{ strtoupper(substr($otherParty, 0, 2)) }}</span>
    </div>
    <div>
        <h2 class="font-bold text-primary text-sm">{{ $otherParty }}</h2>
        @if($conversation->product)
        <p class="text-[11px] text-on-surface-variant">À propos de : {{ $conversation->product->name }}</p>
        @endif
    </div>
    {{-- Indicateur de connexion temps réel --}}
    <span class="ml-auto flex items-center gap-1.5 text-[10px] text-on-surface-variant" id="connection-status">
        <span class="w-1.5 h-1.5 rounded-full bg-outline-variant" id="connection-dot"></span>
        Connexion...
    </span>
</header>

<div class="chat-window">

    <div class="messages-area" id="messages-area">
        @foreach($conversation->messages as $msg)
        <div class="msg-row {{ $msg->sender_id === $currentUserId ? 'mine' : 'theirs' }}" data-message-id="{{ $msg->id }}">
            <div>
                <div class="msg-bubble">
                    @if($msg->attachment_url)
                    <img src="{{ $msg->attachment_url }}" class="max-w-full rounded mb-2" />
                    @endif
                    @if($msg->body)
                    <p>{{ $msg->body }}</p>
                    @endif
                </div>
                <p class="msg-time">{{ $msg->created_at->format('H:i') }}</p>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Formulaire d'envoi --}}
    <div class="border-t border-outline-variant/30 bg-surface p-4">
        <form id="message-form" class="flex items-end gap-3">
            <button type="button" id="attach-btn" class="p-2.5 text-on-surface-variant hover:text-primary transition-colors flex-shrink-0">
                <span class="material-symbols-outlined">attach_file</span>
            </button>
            <input type="file" id="attachment-input" accept="image/*" class="hidden" />

            <textarea
                id="message-input"
                rows="1"
                placeholder="Écrivez votre message..."
                class="flex-1 border border-outline-variant px-4 py-2.5 text-sm resize-none focus:outline-none focus:border-secondary max-h-32"></textarea>

            <button type="submit" class="p-2.5 bg-primary text-white hover:bg-on-surface-variant transition-colors flex-shrink-0" id="send-btn">
                <span class="material-symbols-outlined">send</span>
            </button>
        </form>
        <div id="attachment-preview" class="hidden mt-2 flex items-center gap-2 text-xs text-on-surface-variant">
            <span class="material-symbols-outlined text-[16px]">image</span>
            <span id="attachment-name"></span>
            <button type="button" onclick="clearAttachment()" class="text-error">×</button>
        </div>
    </div>

</div>
@vite(['resources/js/app.js'])
@endsection

@section('extra-scripts')

{{--
    ════════════════════════════════════════════════════════════════
    INTÉGRATION LARAVEL ECHO + REVERB (CHAT TEMPS RÉEL)
    ════════════════════════════════════════════════════════════════
    Ces scripts viennent du CDN pour la démo. En production, tu les
    installeras via npm et les compileras avec Vite (voir le guide
    d'installation fourni à la fin).
    ════════════════════════════════════════════════════════════════
--}}

<script>
document.addEventListener('DOMContentLoaded', function() {

    const CURRENT_USER_ID = @json(auth()->id());
    const SEND_URL        = @json(route('chat.send', $conversation));
    const POLL_URL        = @json(url('/messagerie/' . $conversation->id . '/nouveaux'));
    const CONVERSATION_ID = @json($conversation->id);
    const CSRF_TOKEN      = document.querySelector('meta[name="csrf-token"]').content;
    const messagesArea    = document.getElementById('messages-area');

    messagesArea.scrollTop = messagesArea.scrollHeight;
    var lastMessageId = @json($conversation->messages->last()?->id ?? 0);

    // ══════════════════════════════════════════════════════
    // REVERB — Écoute temps réel
    // ══════════════════════════════════════════════════════
    if (typeof window.Echo !== 'undefined') {
        // Echo est disponible (configuré dans bootstrap.js via Vite)
        window.Echo.private('conversation.' + CONVERSATION_ID)
            .listen('MessageSent', function(data) {
                console.log('Reverb reçu:', data);
                if (data.sender_id !== CURRENT_USER_ID) {
                    appendMessage(data, false);
                }
                lastMessageId = Math.max(lastMessageId, data.id);
            });
        console.log('Reverb connecté sur conversation.' + CONVERSATION_ID);
    } else {
        // Fallback polling si Echo non disponible
        console.log('Echo non disponible — fallback polling 3s');
        startPolling();
    }

    // Polling de secours
    function startPolling() {
        setInterval(async function() {
            try {
                const res  = await fetch(POLL_URL + '?after=' + lastMessageId, {
                    headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF_TOKEN }
                });
                const data = await res.json();
                if (data.messages && data.messages.length > 0) {
                    data.messages.forEach(function(msg) {
                        if (msg.sender_id !== CURRENT_USER_ID) {
                            appendMessage(msg, false);
                        }
                        lastMessageId = Math.max(lastMessageId, msg.id);
                    });
                }
            } catch (e) {}
        }, 3000);
    }

    // ══════════════════════════════════════════════════════
    // ENVOI
    // ══════════════════════════════════════════════════════
    document.getElementById('message-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const input = document.getElementById('message-input');
        const body  = input.value.trim();
        if (!body) return;

        const btn = document.getElementById('send-btn');
        btn.disabled = true;

        try {
            const res = await fetch(SEND_URL, {
                method:  'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept':       'application/json',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ body: body }),
            });

            const data = await res.json();

            if (data.id) {
                appendMessage(data, true);
                input.value = '';
                input.style.height = 'auto';
                lastMessageId = data.id;
            }
        } catch (err) {
            console.error('Erreur envoi:', err);
        } finally {
            btn.disabled = false;
            input.focus();
        }
    });

    // ══════════════════════════════════════════════════════
    // AFFICHER UN MESSAGE
    // ══════════════════════════════════════════════════════
    function appendMessage(data, isMine) {
        var row = document.createElement('div');
        row.className = 'msg-row ' + (isMine ? 'mine' : 'theirs');

        var bubble = document.createElement('div');
        bubble.className = 'msg-bubble';
        bubble.textContent = data.body;

        var time = document.createElement('p');
        time.className = 'msg-time';
        time.textContent = data.created_at_human || '';

        var wrapper = document.createElement('div');
        wrapper.appendChild(bubble);
        wrapper.appendChild(time);
        row.appendChild(wrapper);

        messagesArea.appendChild(row);
        messagesArea.scrollTop = messagesArea.scrollHeight;
    }

    // Entrée pour envoyer
    document.getElementById('message-input').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('message-form').requestSubmit();
        }
    });

}); // fin DOMContentLoaded
</script>
@endsection
