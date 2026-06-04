@extends('layouts.app')
@section('title', 'À propos — ' . ($infos['nom_societe'] ?? 'ADENIKE-INTER'))

@section('content')

{{-- BANNER --}}
<section class="pt-32 pb-20 bg-primary">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block px-4 py-1.5 bg-accent/20 text-accent rounded-full text-sm font-semibold mb-4">À propos</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Notre histoire, nos valeurs</h1>
        <p class="text-steel-light max-w-2xl mx-auto text-lg">Depuis 2017, nous bâtissons la confiance avec nos clients et partenaires.</p>
    </div>
</section>

{{-- HISTOIRE --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="reveal-left relative">
                @if(count($entrepriseImages) > 0)
                    <img src="{{ $entrepriseImages[0]['image'] }}" alt="ADENIKE-INTER" class="w-full rounded-2xl shadow-2xl object-cover aspect-[4/3]" />
                @else
                    <div class="w-full aspect-[4/3] rounded-2xl bg-gradient-to-br from-sand to-sand-dark"></div>
                @endif
                <div class="absolute -bottom-6 -right-6 bg-accent text-white p-6 rounded-2xl shadow-xl hidden sm:block animate-float">
                    <p class="text-3xl font-bold">2017</p>
                    <p class="text-sm text-white/80">Année de création</p>
                </div>
            </div>

            <div class="reveal">
                <span class="inline-block px-4 py-1.5 bg-accent/10 text-accent rounded-full text-sm font-semibold mb-4">Notre histoire</span>
                <h2 class="text-3xl font-bold text-primary mb-6">Fondée en 2017</h2>
                <p class="text-steel text-lg mb-4 leading-relaxed">
                    ADENIKE-INTER SARL est une grande société créée en 2017 au Bénin. Elle est spécialisée dans la commercialisation des matériaux de construction de tout type : plomberie, maçonnerie, menuiserie, barres de fer, tuyauteries, etc.
                </p>
                <p class="text-steel mb-4">
                    Forte de son expertise et de son réseau de fournisseurs directs, ADENIKE-INTER s'approvisionne auprès des fabricants afin de garantir des matériaux de haute qualité à des prix compétitifs. Nous vendons en gros et en détail.
                </p>
                <p class="text-steel">
                    Au-delà de la vente de matériaux, nous intervenons dans la construction de maisons, d'immeubles et de bâtiments divers, en assurant un suivi rigoureux et un respect strict des normes de qualité.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- VALEURS --}}
<section class="py-24 bg-sand">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-accent/10 text-accent rounded-full text-sm font-semibold mb-4">Nos valeurs</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-primary">Ce qui nous guide au quotidien</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['titre' => 'Fiabilité', 'desc' => 'Nous respectons nos engagements avec rigueur. Délais, spécifications, accords — nous honorons toujours nos promesses.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['titre' => 'Qualité', 'desc' => 'De la sélection des matériaux à l\'exécution des projets, chaque étape est réalisée avec exigence et attention.', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'],
                ['titre' => 'Intégrité', 'desc' => 'Nous agissons avec honnêteté et transparence dans chacune de nos transactions avec clients et fournisseurs.', 'icon' => 'M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3'],
                ['titre' => 'Respect', 'desc' => 'Nous respectons nos clients, collaborateurs, partenaires et les normes en vigueur. Le respect mutuel est essentiel.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                ['titre' => 'Engagement', 'desc' => 'Chaque projet bénéficie d\'un engagement total. Suivi rigoureux et résultats à la hauteur des attentes.', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
                ['titre' => 'Excellence', 'desc' => 'Portés par une recherche constante d\'excellence, nous visons l\'amélioration continue dans chacun de nos services.', 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
            ] as $i => $v)
                <div class="reveal delay-{{ ($i % 3) + 1 }} bg-white rounded-2xl p-8 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 group">
                    <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center mb-5 group-hover:bg-accent group-hover:scale-110 transition-all">
                        <svg class="w-6 h-6 text-accent group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $v['icon'] }}"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-primary mb-3">{{ $v['titre'] }}</h3>
                    <p class="text-sm text-steel leading-relaxed">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ÉQUIPE (depuis API) --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-accent/10 text-accent rounded-full text-sm font-semibold mb-4">Notre équipe</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-4">Une équipe pluridisciplinaire</h2>
            <p class="text-steel max-w-3xl mx-auto">Direction, comptabilité, magasiniers, manutentionnaires, conducteurs et personnel de chantier — chaque collaborateur contribue à notre excellence.</p>
        </div>

        @if(count($equipeImages) > 0)
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($equipeImages as $i => $img)
                    <div class="reveal delay-{{ ($i % 4) + 1 }} group bg-sand rounded-2xl overflow-hidden hover:shadow-lg transition-all">
                        <div class="aspect-[3/4] overflow-hidden">
                            <img src="{{ $img['image'] }}" alt="{{ $img['titre'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                        </div>
                        <div class="p-4 text-center">
                            <h4 class="font-bold text-primary">{{ $img['titre'] }}</h4>
                            @if($img['description'] ?? false)
                                <p class="text-sm text-accent">{{ $img['description'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 text-steel">
                <p>Photos de l'équipe bientôt disponibles.</p>
            </div>
        @endif
    </div>
</section>

{{-- PARTENAIRES --}}
<section class="py-20 bg-sand">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-12">
            <span class="inline-block px-4 py-1.5 bg-accent/10 text-accent rounded-full text-sm font-semibold mb-4">Partenaires</span>
            <h2 class="text-3xl font-bold text-primary mb-4">Nos fournisseurs et partenaires</h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-8">
            <div class="reveal bg-white rounded-2xl p-8 shadow-sm">
                <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    Partenaires locaux — Bénin
                </h3>
                <ul class="space-y-3">
                    @foreach(['NOCIBE — Usine de fabrication de ciment', 'FMB — Fer à béton, fil de fer', 'SIAB — Fer à béton, tôles, pointes', 'SBS — Fer à béton', 'IBP — Produits de plomberie', 'Sonimex — Fer à béton'] as $p)
                        <li class="flex items-center gap-3 text-steel text-sm">
                            <div class="w-2 h-2 rounded-full bg-accent flex-shrink-0"></div>
                            {{ $p }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="reveal delay-2 bg-white rounded-2xl p-8 shadow-sm">
                <h3 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Approvisionnement international
                </h3>
                <ul class="space-y-3">
                    @foreach(['Contreplaqués et panneaux de bois ', 'Matériaux et équipements importés '] as $p)
                        <li class="flex items-center gap-3 text-steel text-sm">
                            <div class="w-2 h-2 rounded-full bg-gold flex-shrink-0"></div>
                            {{ $p }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

@endsection