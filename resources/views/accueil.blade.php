<x-layout>
    <section class="relative h-[795px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Luxury Beninese Craftsmanship" class="w-full h-full object-cover" data-alt="A cinematic, high-end photography shot of a handcrafted luxury leather bag and intricate gold jewelry arranged on a minimalist ivory stone surface. The lighting is soft and directional, creating elegant shadows that highlight the textures of the fine leather and the shimmer of the gold. The atmosphere is sophisticated and museum-like, using a color palette of deep charcoal, cream, and rich gold." src="{{ asset('images/home/accueil.png') }}" />
            <div class="absolute inset-0 hero-gradient"></div>
        </div>
        <div class="relative z-10 text-center px-margin-mobile max-w-4xl">
            <!--<p class="font-label-caps text-label-caps text-secondary tracking-[0.3em] mb-6 reveal">HERITAGE &amp; LUXE</p>-->
            <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-8 leading-tight reveal">L'Excellence de l'Artisanat Béninois</h2>
            <div class="flex flex-col md:flex-row gap-6 justify-center reveal">
                <a href="/collection" class="btn-luxury bg-primary text-on-primary px-10 py-4 font-label-caps text-label-caps uppercase tracking-widest shadow-lg hover:shadow-xl hover:scale-105">
                    Explorer la Collection
                </a>
                <a href="#history" class="btn-luxury border border-secondary text-primary px-10 py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-secondary-fixed/15 hover:border-secondary hover:scale-105">
                    Notre Histoire
                </a>
            </div>
        </div>
    </section>
    <!-- Categories Section -->
    <section class="px-margin-mobile md:px-margin-desktop py-section-gap max-w-container-max mx-auto">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
            <div class="reveal">
                <div class="divider-gold"></div>
                <span class="font-label-caps text-label-caps text-secondary mb-2 block">CATÉGORIES</span>
                <h3 class="font-headline-lg text-headline-lg text-primary">Les Univers de l'Éclat</h3>
            </div>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-secondary flex items-center gap-2 transition-all duration-300 group reveal" href="#">
                VOIR TOUT <span class="material-symbols-outlined text-[16px] group-hover:translate-x-1 transition-transform" data-icon="arrow_forward">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
            <!-- Haute Joaillerie -->
            <div class="group cursor-pointer reveal card-luxury" style="transition-delay: 100ms;">
                <a href="/bijoux">
                    <div class="aspect-[3/4] overflow-hidden mb-6 bg-surface-container-low relative shadow-md hover:shadow-xl transition-shadow duration-500">
                        <img alt="Haute Joaillerie" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-115" data-alt="Close-up macro photography of an exquisite handcrafted gold necklace featuring traditional Beninese motifs, presented on a dark, textured velvet bust. The lighting is focused and dramatic, making the gold shimmer against the deep black background. The overall aesthetic is one of extreme luxury and artisanal precision, emphasizing the high-contrast bold style." src="{{ asset('images/home/bijoux.png') }}" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                    </div>

                    <div class="pb-2 text-center">
                        <h5 class="font-headline-lg text-headline-lg text-primary">Haute Joaillerie</h5>
                        <p class="font-body-md text-on-surface-variant text-sm">Or 24 carats &amp; Symboles Royaux</p>
                    </div>
                </a>
                <div class="divider-gold-center"></div>
            </div>

            <!-- Maroquinerie de Luxe -->
            <div class="group cursor-pointer reveal card-luxury" style="transition-delay: 200ms;">
                <a href="/maroquerie">
                    <div class="aspect-[3/4] overflow-hidden mb-6 bg-surface-container-low relative shadow-md hover:shadow-xl transition-shadow duration-500">
                        <img alt="Maroquinerie de Luxe" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-115" data-alt="A luxurious leather handbag in deep emerald green, displayed in a minimalist ivory gallery setting with soft natural light. The stitching is visible and perfect, highlighting the handmade quality. The scene is bright and airy, following the editorial luxury design system with plenty of white space and subtle gold accents in the bag's hardware." src="{{ asset('images/home/maroquerie.png') }}" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                    </div>
                    <div class="pb-2 text-center">
                        <h5 class="font-headline-lg text-headline-lg text-primary">Maroquinerie de Luxe</h5>
                        <p class="font-body-md text-on-surface-variant text-sm">Cuirs d'Exception &amp; Finitions Main</p>
                    </div>
                </a>
                <div class="divider-gold-center"></div>
            </div>
            <!-- Art & Décoration -->
            <div class="group cursor-pointer reveal card-luxury" style="transition-delay: 300ms;">
                <a href="/art">
                    <div class="aspect-[3/4] overflow-hidden mb-6 bg-surface-container-low relative shadow-md hover:shadow-xl transition-shadow duration-500">
                        <img alt="Art &amp; Décoration" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-115" data-alt="A modern Beninese sculpture made of dark wood and brass accents, positioned as a centerpiece on a sleek floating shelf. The background is a warm ivory plaster wall with subtle shadows from a nearby window. The composition is asymmetrical and balanced, reflecting the premium museum gallery aesthetic of the brand." src="{{ asset('images/home/art-deco.png') }}" />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                    </div>
                    <div class="pb-2 text-center">
                        <h5>
                            <h5 class="font-headline-lg text-headline-lg text-primary">Art & Décoration</h5>
                            <p class="font-body-md text-on-surface-variant text-sm">Sculptures Contemporaines &amp; Objets d'Art</p>
                        </h5>
                    </div>
                </a>
                <div class="divider-gold-center"></div>
            </div>
        </div>
    </section>
    <!-- Stade des Artisans Section -->
    <section id="history" class="bg-surface-container-low  overflow-hidden">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-20">
                <div class="relative reveal">
                    <div class="aspect-square bg-surface-container-high relative overflow-hidden">
                        <img alt="Stade des Artisans Mathieu Kérékou" class="w-full h-full object-cover" data-alt="An expansive view of a high-end artisanal workshop located within the Mathieu Kérékou stadium complex in Cotonou. Master artisans are seen working with gold and leather in a modern, light-filled environment. The space features high ceilings, ivory walls, and minimalist workstations, conveying a sense of organized, professional excellence and cultural pride." src="{{ asset('images/home/history.png') }}" />
                    </div>
                    <!-- Floating Badge -->
                    <div class="absolute -bottom-10 -right-10 bg-primary text-on-primary p-12 hidden md:block">
                        <p class="font-label-caps text-label-caps tracking-widest text-center mb-2">LOCALISATION</p>
                        <p class="font-headline-md text-headline-md text-center">COTONOU</p>
                    </div>
                </div>
                <div class="reveal">
                    <div class="divider-gold"></div>
                    <span class="font-label-caps text-label-caps text-secondary mb-4 block">LE CŒUR VIVANT DE L’ARTISANAT BÉNINOIS</span>
                    <h3 class="font-display-lg text-display-lg-mobile md:text-headline-lg text-primary mb-8">Le Stade des Artisans</h3>
                    <p class="font-body-lg text-body-lg text-on-surface-variant mb-10 leading-relaxed text-sm">
                        Le Bénin est une terre de création, où chaque région, chaque ville et chaque atelier porte une part vivante d’un savoir-faire transmis de génération en génération. De Cotonou à Porto-Novo, en passant par Abomey et les régions du Nord, des mains expertes façonnent des œuvres uniques qui racontent une histoire commune : celle de l’excellence artisanale béninoise.
                        Notre plateforme est un pont entre ces talents et le monde. Elle réunit les créateurs, les maisons artisanales et les ateliers indépendants dans un même espace dédié à la valorisation du luxe authentique africainIci, chaque pièce est plus qu’un produit : c’est une signature, une mémoire, une identité.
                        Nous ne célébrons pas un lieu unique, mais tout un territoire de création, où tradition et modernité se rencontrent pour donner naissance à des œuvres d’exception.
                    </p>
                    <div class="grid grid-cols-2 gap-6 mb-12">
                        <div class="flex items-start gap-4 p-4 rounded-sm bg-surface-container-low/50 hover:bg-surface-container-low transition-all duration-300">
                            <span class="material-symbols-outlined text-secondary text-2xl flex-shrink-0" data-icon="verified">verified</span>
                            <div>
                                <h5 class="font-label-caps text-label-caps text-primary mb-1">AUTHENTICITÉ</h5>
                                <p class="font-body-md text-xs text-on-surface-variant">Certifiée par nos maîtres d'art</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-sm bg-surface-container-low/50 hover:bg-surface-container-low transition-all duration-300">
                            <span class="material-symbols-outlined text-secondary text-2xl flex-shrink-0" data-icon="history_edu">history_edu</span>
                            <div>
                                <h5 class="font-label-caps text-label-caps text-primary mb-1">SAVOIR-FAIRE</h5>
                                <p class="font-body-md text-xs text-on-surface-variant">Tradition & Modernité</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-sm bg-surface-container-low/50 hover:bg-surface-container-low transition-all duration-300">
                            <span class="material-symbols-outlined text-secondary text-2xl flex-shrink-0" data-icon="diamond">diamond</span>
                            <div>
                                <h5 class="font-label-caps text-label-caps text-primary mb-1">EXCELLENCE</h5>
                                <p class="font-body-md text-xs text-on-surface-variant">Matériaux premium</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-sm bg-surface-container-low/50 hover:bg-surface-container-low transition-all duration-300">
                            <span class="material-symbols-outlined text-secondary text-2xl flex-shrink-0" data-icon="public">public</span>
                            <div>
                                <h5 class="font-label-caps text-label-caps text-primary mb-1">PRESTIGE</h5>
                                <p class="font-body-md text-xs text-on-surface-variant">Reconnaissance mondiale</p>
                            </div>
                        </div>
                    </div>
                    <button class="btn-luxury border-b-2 border-primary pb-2 font-label-caps text-label-caps hover:text-secondary hover:border-secondary transition-all duration-300">
                        DÉCOUVRIR LES ATELIERS
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter / Contact CTA -->
    <section class="py-section-gap px-margin-mobile text-center max-w-3xl mx-auto reveal">
        <div class="divider-gold-center"></div>
        <h3 class="font-display-lg text-headline-lg text-primary mb-4">Restez à l'affût de l'Éclat</h3>
        <span class="badge-premium mb-6 block">Exclusivité & Inspiration</span>
        <p class="font-body-lg text-on-surface-variant mb-12">Recevez en exclusivité nos nouvelles collections et les récits de nos artisans.</p>
        <div class="flex flex-col md:flex-row gap-4 max-w-2xl mx-auto">
            <div class="flex-1 input-luxury">
                <input class="w-full bg-transparent border-b-2 border-outline text-primary focus:border-secondary focus:ring-0 font-body-md py-4 outline-none transition-all placeholder:text-on-surface-variant/40" placeholder="votre@email.com" type="email" />
            </div>
            <button class="btn-luxury bg-primary text-on-primary px-12 py-4 font-label-caps text-label-caps tracking-widest uppercase shadow-lg hover:shadow-xl hover:scale-105">
                S'INSCRIRE
            </button>
        </div>
    </section>
</x-layout>
