{{-- resources/views/cart/partials/empty.blade.php --}}
<div class="flex flex-col items-center justify-center h-full px-8 text-center py-16">
    <div class="w-20 h-20 border border-dashed border-outline-variant flex items-center justify-center mb-6">
        <span class="material-symbols-outlined text-4xl text-outline-variant">shopping_bag</span>
    </div>
    <p class="font-bold text-primary text-sm uppercase tracking-widest mb-2" style="font-family:'Playfair Display',serif">
        Votre panier est vide
    </p>
    <p class="text-xs text-on-surface-variant leading-relaxed max-w-xs">
        Explorez nos collections pour y ajouter vos pièces de prestige artisanal.
    </p>
    <a href="{{ route('collection.index') }}"
       onclick="closeCart()"
       class="mt-8 inline-block bg-primary text-white px-8 py-3 font-label-caps text-[10px] tracking-widest uppercase hover:bg-primary/90 transition-all">
        Découvrir la Collection
    </a>
</div>
