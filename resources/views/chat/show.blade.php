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
                class="flex-1 border border-outline-variant px-4 py-2.5 text-sm resize-none focus:outline-none focus:border-secondary max-h-32"
            ></textarea>

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
<script src="https://cdn.jsdelivr.net/npm/pusher-js@8.4.0/dist/web/pusher.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.16.1/dist/echo.iife.js"></script>

<script>
const CURRENT_USER_ID  = {{ $currentUserId }};
const CONVERSATION_ID  = {{ $conversation->id }};
const SEND_URL         = "{{ route('chat.send', $conversation) }}";
const CSRF_TOKEN       = document.querySelector('meta[name="csrf-token"]').content;

const messagesArea = document.getElementById('messages-area');

// Toujours scroller en bas au chargement
messagesArea.scrollTop = messagesArea.scrollHeight;

/**
 * ═══ CONFIGURATION DE LARAVEL ECHO (client WebSocket) ═══
 * Echo se connecte au serveur Reverb qui tourne en parallèle de Laravel.
 * broadcaster: 'reverb' indique explicitement qu'on utilise Reverb
 * (et non Pusher.com ou un autre service).
 *
 * Les valeurs VITE_REVERB_* viennent de ton fichier .env (voir le
 * guide d'installation). Ici on les "simule" en dur pour que le code
 * soit lisible — remplace-les par tes vraies valeurs .env.
 */
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: '{{ config('broadcasting.connections.reverb.key') }}',
    wsHost: '{{ config('broadcasting.connections.reverb.options.host') }}',
    wsPort: {{ config('broadcasting.connections.reverb.options.port', 8080) }},
    wssPort: {{ config('broadcasting.connections.reverb.options.port', 8080) }},
    forceTLS: {{ config('broadcasting.connections.reverb.options.useTLS', 'false') }},
    enabledTransports: ['ws', 'wss'],
    authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN,
        },
    },
});

// Indicateur visuel de connexion
Echo.connector.pusher.connection.bind('connected', () => {
    document.getElementById('connection-dot').style.background = '#5e8e77';
    document.getElementById('connection-status').lastChild.textContent = ' En direct';
});
Echo.connector.pusher.connection.bind('disconnected', () => {
    document.getElementById('connection-dot').style.background = '#ba1a1a';
    document.getElementById('connection-status').lastChild.textContent = ' Hors ligne';
});

/**
 * ═══ ÉCOUTE DU CANAL PRIVÉ DE CETTE CONVERSATION ═══
 * Dès qu'un message est diffusé par le serveur (voir MessageSent event
 * côté PHP), cette fonction s'exécute et ajoute le message à l'écran
 * SANS aucun rechargement de page.
 */
Echo.private(`conversation.${CONVERSATION_ID}`)
    .listen('MessageSent', (data) => {
        // On ignore nos propres messages (déjà affichés localement à l'envoi)
        if (data.sender_id === CURRENT_USER_ID) return;
        appendMessage(data, false);
    });

/**
 * Ajoute visuellement un message dans la zone de chat
 */
function appendMessage(data, isMine) {
    const row = document.createElement('div');
    row.className = `msg-row ${isMine ? 'mine' : 'theirs'}`;
    row.dataset.messageId = data.id;

    let attachmentHtml = '';
    if (data.attachment_url) {
        attachmentHtml = `<img src="${data.attachment_url}" class="max-w-full rounded mb-2" />`;
    }

    row.innerHTML = `
        <div>
            <div class="msg-bubble">
                ${attachmentHtml}
                ${data.body ? `<p>${escapeHtml(data.body)}</p>` : ''}
            </div>
            <p class="msg-time">${data.created_at_human}</p>
        </div>
    `;

    messagesArea.appendChild(row);
    messagesArea.scrollTop = messagesArea.scrollHeight;
}

function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

// ─── GESTION DE LA PIÈCE JOINTE ───
const attachInput = document.getElementById('attachment-input');
document.getElementById('attach-btn').addEventListener('click', () => attachInput.click());

attachInput.addEventListener('change', function() {
    if (this.files[0]) {
        document.getElementById('attachment-preview').classList.remove('hidden');
        document.getElementById('attachment-name').textContent = this.files[0].name;
    }
});

function clearAttachment() {
    attachInput.value = '';
    document.getElementById('attachment-preview').classList.add('hidden');
}

// ─── ENVOI DE MESSAGE ───
document.getElementById('message-form').addEventListener('submit', async function(e) {
    e.preventDefault();

    const input = document.getElementById('message-input');
    const body  = input.value.trim();
    const file  = attachInput.files[0];

    if (!body && !file) return;

    const formData = new FormData();
    formData.append('body', body);
    if (file) formData.append('attachment', file);

    // Désactiver le bouton pendant l'envoi
    document.getElementById('send-btn').disabled = true;

    try {
        const response = await fetch(SEND_URL, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
            body: formData,
        });

        const data = await response.json();

        // Afficher immédiatement le message envoyé (sans attendre le broadcast)
        appendMessage(data, true);

        input.value = '';
        clearAttachment();

    } catch (err) {
        alert('Erreur lors de l\'envoi du message. Réessayez.');
    } finally {
        document.getElementById('send-btn').disabled = false;
    }
});

// Envoyer avec Entrée (Maj+Entrée pour saut de ligne)
document.getElementById('message-input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        document.getElementById('message-form').requestSubmit();
    }
});

// Auto-resize du textarea
document.getElementById('message-input').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 128) + 'px';
});
</script>
@endsection
