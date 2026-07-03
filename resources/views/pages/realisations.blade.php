@extends('layouts.app')
@section('title', 'Nos réalisations — ' . ($infos['nom_societe'] ?? 'ADENIKE-INTER'))

@section('content')

{{-- BANNIÈRE --}}
<section class="relative pt-36 pb-20 bg-primary overflow-hidden">
    <div class="hidden lg:block absolute inset-y-0 right-0 w-1/3 bg-primary-light" style="clip-path: polygon(35% 0, 100% 0, 100% 100%, 0 100%);"></div>
    <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center gap-2 pl-2 pr-4 py-1.5 mb-6 border border-accent/40 rounded-sm">
            <span class="px-2 py-0.5 bg-accent text-white text-[11px] font-bold tracking-wide">PORTFOLIO</span>
            <span class="text-white/70 text-xs sm:text-sm font-medium">Depuis 2017</span>
        </div>
        <h1 class="font-['Oswald',sans-serif] uppercase text-4xl lg:text-5xl font-bold text-white mb-4">Nos réalisations</h1>
        <p class="text-steel-light max-w-2xl mx-auto text-lg">Découvrez nos projets de construction et nos sites au Bénin.</p>
    </div>
</section>

{{-- PROJETS — INDEX DE PORTFOLIO --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 divide-y divide-sand-dark">
        @foreach([
            ['titre' => 'Complexe Scolaire « La Madone »', 'desc' => 'Reconstruction complète d\'un complexe scolaire — de la démolition à la livraison.', 'tag' => 'Construction publique'],
            ['titre' => 'Magasin de Tanzoun — Porto-Novo', 'desc' => 'Construction et aménagement d\'un magasin de vente de matériaux de construction.', 'tag' => 'Infrastructure commerciale'],
            ['titre' => 'Magasin de Dangbo', 'desc' => 'Construction d\'un grand espace de stockage et vente, en face de l\'IMSP.', 'tag' => 'Infrastructure commerciale'],
            ['titre' => 'Maisons résidentielles', 'desc' => 'Construction de plusieurs maisons modernes et durables adaptées aux besoins des clients.', 'tag' => 'Résidentiel'],
        ] as $i => $projet)
            <div class="reveal group relative py-12 lg:py-14 grid lg:grid-cols-[auto_1fr] gap-6 lg:gap-12 items-start overflow-hidden">

                {{-- grand chiffre fantôme --}}
                <span class="font-['Oswald',sans-serif] font-bold text-transparent text-7xl lg:text-8xl leading-none select-none
                             [-webkit-text-stroke:1.5px_var(--tw-content-color,theme(colors.sand-dark))]
                             lg:w-32 lg:flex-shrink-0"
                      style="-webkit-text-stroke: 1.5px #f0ece6;">
                    {{ sprintf('%02d', $i + 1) }}
                </span>

                <div class="min-w-0">
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-accent/10 text-accent text-xs font-bold uppercase tracking-wide">{{ $projet['tag'] }}</span>
                    </div>
                    <h3 class="font-['Oswald',sans-serif] uppercase text-2xl lg:text-3xl font-bold text-primary mb-3 group-hover:text-accent transition-colors">
                        {{ $projet['titre'] }}
                    </h3>
                    <p class="text-steel max-w-2xl leading-relaxed">{{ $projet['desc'] }}</p>
                </div>

                {{-- liseré accent qui se déploie au survol --}}
                <span class="absolute left-0 bottom-0 h-[2px] bg-accent w-0 group-hover:w-full transition-all duration-500"></span>
            </div>
        @endforeach
    </div>
</section>

{{-- GALERIE RÉALISATIONS (depuis API) --}}
@if(count($serviceImages) > 0)
<section class="py-24 bg-sand">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-16">
            <span class="inline-flex items-center gap-2 justify-center mb-4">
                <span class="w-6 h-px bg-accent"></span>
                <span class="text-accent text-xs font-bold uppercase tracking-widest">En images</span>
                <span class="w-6 h-px bg-accent"></span>
            </span>
            <h2 class="font-['Oswald',sans-serif] uppercase text-3xl font-bold text-primary">Galerie photos</h2>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($serviceImages as $i => $img)
                <div class="reveal delay-{{ ($i % 3) + 1 }} group relative overflow-hidden shadow-sm hover:shadow-xl transition-all"
                     style="clip-path: polygon(0 0, 100% 0, 100% 100%, 12px 100%, 0 calc(100% - 12px));">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ $img['image'] }}" alt="{{ $img['titre'] ?? '' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                    </div>
                    @if($img['titre'] ?? false)
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/85 via-primary/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                            <p class="font-semibold text-white text-sm">{{ $img['titre'] }}</p>
                            @if($img['description'] ?? false)
                                <p class="text-xs text-white/70 mt-1">{{ $img['description'] }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="relative py-16 bg-accent overflow-hidden">
    <div class="hidden lg:block absolute inset-y-0 right-0 w-1/3 bg-accent-dark" style="clip-path: polygon(30% 0, 100% 0, 100% 100%, 0 100%);"></div>
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="font-['Oswald',sans-serif] uppercase text-2xl lg:text-3xl font-bold text-white mb-4">Vous avez un projet de construction ?</h2>
        <p class="text-white/80 mb-6">Confiez-nous votre projet et bénéficiez de notre expertise.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-10 py-4 bg-white text-accent font-bold text-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
            Discutons de votre projet
        </a>
    </div>
</section>

@endsection