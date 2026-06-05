<x-collection.layout>
    <!-- Hero Section -->
        <section class="px-margin-mobile md:px-margin-desktop mb-24 max-w-container-max mx-auto">
            <div class="flex flex-col md:flex-row gap-12 items-end">
                <div class="w-full md:w-1/2">
                    <span class="font-label-caps text-label-caps text-secondary mb-4 block">LES TRÉSORS DE COTONOU</span>
                    <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-primary leading-none mb-8">Haute Joaillerie</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-lg mb-8">
                        Découvrez l'artisanat béninois. Chaque pièce est un dialogue unique entre techniques ancestrales et luxe contemporain, forgé au cœur de nos ateliers côtiers.
                    </p>
                </div>
                <div class="w-full md:w-1/2 flex justify-end">
                    <div class="relative w-full aspect-[4/5] bg-surface-container-low overflow-hidden">
                        <img class="w-full h-full object-cover" data-alt="A macro photograph of an intricate 24k gold necklace with traditional Beninese motifs, resting on an ivory silk background. The lighting is soft and golden, highlighting the handcrafted texture of the filigree. The aesthetic is high-end editorial, evoking a sense of heritage and extreme luxury through minimalist composition and rich contrast." src="{{ asset('images/bijoux/hero.png') }}" />
                    </div>
                </div>
            </div>
        </section>
        <!-- Category Filters -->
        <nav class="sticky top-20 z-40 bg-surface/90 backdrop-blur-md border-y border-outline-variant/10 py-6 mb-16">
            <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto flex flex-wrap justify-between items-center gap-4">
                <div class="flex gap-8">
                    <button class="font-label-caps text-label-caps text-primary border-b-2 border-primary pb-1">TOUTES LES COLLECTIONS</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1">COLLIERS</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1">BAGUES</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1">BOUCLES D'OREILLES</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1">Bracelet</button>

                </div>
            </div>
        </nav>
        <!-- Product Grid -->
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-20 gap-x-gutter">
            <!-- Product Item 1 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Close-up of a royal gold torque necklace featuring embossed traditional iconography of the Fon people. The piece is displayed in a bright museum-like setting with soft directional light hitting the gold surfaces. The background is a clean, ivory-toned plaster wall that adds a tactile yet minimalist feel to the luxury jewelry presentation." src="{{ asset('images/bijoux/colier.png')}}" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Maison Artisan: Koffi Adande</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Le torque royal d'Ouidah</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">1.450.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 2 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A handcrafted gold cuff bracelet with a complex geometric texture inspired by Beninese tapestry. It rests on a textured stone surface under bright, clear daylight, creating sharp elegant shadows. The color palette is dominated by warm golds and cool off-white tones, adhering to the high-contrast editorial luxury style." src="{{ asset('images/bijoux/bracelet.png')}}" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Maison Artisan: Sika Léwé</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Bracelet « Héritage géométrique »</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">890.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 3 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Dangling statement earrings featuring polished black onyx and fine gold filigree. The earrings are captured in mid-air against a soft ivory gradient background. The lighting is dramatic, high-contrast, creating a shimmering effect on the gold details. The image feels like a page from a premium fashion magazine, emphasizing elegance and cultural depth." src="{{ asset('images/bijoux/boucle.png')}}" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Maison Artisan: Bakare Ibrahim</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Boucles d'oreilles Onyx Night Drop</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">520.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 4 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A statement cocktail ring with a large emerald cut gemstone set in a heavy gold band with hand-carved relief work. The ring is worn by a model with a dark skin tone, emphasizing the contrast between the rich gold and the skin. The setting is minimal, with soft light creating a luxury boutique atmosphere. Warm ivory and deep gold tones dominate." src="{{ asset('images/bijoux/bag.png')}}" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Maison Artisan: Koffi Adande</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Sceau en émeraude du Dahomey</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">2.100.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 5 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Layered gold necklaces of varying lengths with artisanal pendants representing Beninese cultural symbols. The jewelry is neatly arranged on an off-white linen cloth. The aesthetic is clean, sophisticated, and focused on material quality. Lighting is bright and airy, typical of a luxury lifestyle brand." src="{{ asset('images/bijoux/collier.png')}}" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Maison Artisan: Sika Lawson</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Pendentifs « Trinity of the Coast »</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">680.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 6 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A collection of delicate gold rings with tiny precious stone accents, arranged artistically inside a minimalist ceramic dish. The color palette features ivory, warm cream, and brilliant gold. The image is captured with a shallow depth of field, highlighting the fine detail of the metalwork. It exudes a feeling of refined luxury and artisanal precision." src="{{ asset('images/bijoux/bouclle.png')}}" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Maison Artisan: Bakare Ibrahim</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Le coffret de poupées artisanales à empiler</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">450.000 FCFA</p>
                </div>
            </article>
        </section>
        <!-- Newsletter / Heritage Section -->
        <section class="mt-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="bg-primary text-on-primary p-12 md:p-24 flex flex-col items-center text-center">
                <span class="font-label-caps text-label-caps text-secondary-fixed mb-6">LE CERCLE DES ARTISANS</span>
                <h2 class="font-display-lg text-headline-lg md:text-display-lg-mobile lg:text-headline-lg mb-8 max-w-2xl">Des créations sur mesure venues du cœur du Bénin</h2>
                <p class="font-body-lg text-body-lg text-on-primary/70 max-w-xl mb-12">
                    Contactez nos maîtres artisans pour commander une pièce sur mesure qui racontera votre histoire unique à travers le prisme de l'excellence ouest-africaine.
                </p>
                <div class="w-full max-w-md flex flex-col md:flex-row gap-4">
                    <input class="bg-transparent border-b border-on-primary/30 py-3 px-1 font-body-md text-on-primary focus:border-secondary outline-none transition-colors flex-grow" placeholder="Your Email" type="email" />
                    <button class="bg-on-primary text-primary px-10 py-3 font-label-caps text-label-caps hover:bg-secondary-fixed transition-colors">DEMANDE DE RENSEIGNEMENTS</button>
                </div>
            </div>
        </section>
</x-collection.layout>