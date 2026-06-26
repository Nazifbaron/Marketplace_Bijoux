@extends('layouts.artisan')

@section('title', 'Messagerie')

@section('content')

<header class="sticky top-0 z-40 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 px-8 py-4">
    <h2 class="font-bold text-primary" style="font-family:'Playfair Display',serif; font-size:20px;">Messagerie</h2>
    <p class="text-xs text-on-surface-variant mt-0.5">Échangez en temps réel avec vos clients</p>
</header>

<main class="flex-1 p-8">

    @if($conversations->isEmpty())
        <div class="bg-surface border border-outline-variant/30 py-20 flex flex-col items-center justify-center text-center px-8">
            <div class="w-16 h-16 border border-dashed border-outline-variant flex items-center justify-center mb-5">
                <span class="material-symbols-outlined text-3xl text-outline-variant">chat_bubble</span>
            </div>
            <p class="font-semibold text-primary text-sm uppercase tracking-widest mb-2">Aucune conversation</p>
            <p class="text-xs text-on-surface-variant max-w-xs leading-relaxed">
                Quand un client vous contactera depuis une fiche produit, la discussion apparaîtra ici.
            </p>
        </div>
    @else
        <div class="bg-surface border border-outline-variant/30 divide-y divide-outline-variant/20">
            @foreach($conversations as $conv)
                @php
                    $unread = $conv->unreadCountFor(auth()->id());
                    $otherName = $vendorApplication ? $conv->buyer->name : ($conv->vendor->shop_name ?? $conv->vendor->full_name);
                @endphp
                <a href="{{ route('chat.show', $conv) }}" class="flex items-center gap-4 px-6 py-5 hover:bg-surface-container-low transition-colors">
                    <div class="w-12 h-12 bg-primary flex items-center justify-center flex-shrink-0 relative">
                        <span class="text-white text-sm font-bold uppercase">{{ strtoupper(substr($otherName, 0, 2)) }}</span>
                        @if($unread > 0)
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-error text-white text-[10px] font-bold rounded-full flex items-center justify-center">{{ $unread }}</span>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-primary {{ $unread > 0 ? '' : '' }}">{{ $otherName }}</p>
                            <span class="text-[11px] text-on-surface-variant flex-shrink-0">{{ $conv->last_message_at?->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-on-surface-variant truncate mt-1 {{ $unread > 0 ? 'font-semibold text-primary' : '' }}">
                            {{ $conv->latestMessage->body ?? 'Nouvelle conversation' }}
                        </p>
                    </div>
                    <span class="material-symbols-outlined text-outline-variant flex-shrink-0">chevron_right</span>
                </a>
            @endforeach
        </div>
    @endif

</main>

@endsection
