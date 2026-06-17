@extends('layouts.app')
@section('title', ($infos['nom_societe'] ?? 'ADENIKE-INTER') . ' — Matériaux de construction & BTP au Bénin')

@php
    $whatsapp = preg_replace('/\D/', '', $infos['whatsapp'] ?? $infos['telephone'] ?? '22901664427031');
@endphp

@section('content')
@include('partials.schema')

{{-- HERO SLIDER --}}

<section class="relative h-screen min-h-[600px] max-h-[900px] overflow-hidden">

    {{-- IMAGES --}}
    @if(count($heroImages) > 0)
        @foreach($heroImages as $i => $slide)
            <div class="hero-slide absolute inset-0 transition-all duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                <img src="{{ $slide['image'] }}" alt="{{ $slide['titre'] ?? '' }}" class="w-full h-full object-cover" />
            </div>
        @endforeach
    @endif

    {{-- OVERLAY --}}
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>

    {{-- CONTENT --}}
    <div class="relative z-10 h-full flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full">

            {{-- CONTENEUR TEXTE --}}
            <div class="max-w-xl sm:max-w-2xl pr-6 sm:pr-16 lg:pr-24">

                {{-- BADGE --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-accent/20 border border-accent/30 rounded-full mb-5 backdrop-blur-sm">
                    <div class="w-2 h-2 rounded-full bg-accent animate-pulse"></div>
                    <span class="text-accent text-xs sm:text-sm font-medium">
                        {{ $infos['nom_societe'] ?? 'ADENIKE-INTER' }} — Depuis 2017
                    </span>
                </div>

                {{-- TEXT SLIDER --}}
                <div class="relative min-h-[160px] sm:min-h-[200px] pb-6">

                    @foreach($heroImages as $i => $slide)
                        <div class="hero-text absolute left-0 top-0 w-full transition-all duration-700
                            {{ $i === 0 ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6 pointer-events-none' }}">

                            {{-- TITRE --}}
                            <h1 class="text-2xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4 max-w-3xl ">
                                {{ $slide['titre'] ?? 'Matériaux de construction' }}
                            </h1>

                            {{-- DESCRIPTION --}}
                            <p class="text-sm sm:text-base lg:text-lg text-white/70 mb-6 max-w-md">
                                {{ $slide['description'] ?? 'Qualité, fiabilité et expertise au service de vos ambitions.' }}
                            </p>

                        </div>
                    @endforeach

                </div>

                {{-- BOUTONS --}}
                <div class="flex flex-wrap gap-4 mt-20 ">
                    <a href="{{ route('contact') }}"
                       class="group inline-flex items-center gap-2 px-6 sm:px-8 py-3 sm:py-4 bg-accent hover:bg-accent-dark text-white rounded-xl font-semibold transition-all hover:shadow-xl hover:-translate-y-0.5">
                        Demander un devis
                    </a>

                    <a href="tel:{{ $infos['telephone'] ?? '' }}"
                       class="inline-flex items-center gap-2 px-6 sm:px-8 py-3 sm:py-4 bg-white/10 hover:bg-white/20 text-white rounded-xl font-semibold backdrop-blur-sm border border-white/20 transition-all">
                        Appeler
                    </a>
                </div>

            </div>
        </div>
    </div>

    {{-- NAVIGATION --}}
    @if(count($heroImages) > 1)

        {{-- PREV --}}
        <button id="heroPrev"
            class="absolute left-4 top-1/2 -translate-y-1/2 z-30 p-3 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full text-white transition hidden sm:block">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- NEXT --}}
        <button id="heroNext"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-30 p-3 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full text-white transition hidden sm:block">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- DOTS --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex gap-2">
            @foreach($heroImages as $i => $s)
                <button class="hero-dot h-1.5 rounded-full transition-all duration-500
                    {{ $i === 0 ? 'w-8 bg-accent' : 'w-4 bg-white/40' }}">
                </button>
            @endforeach
        </div>

    @endif

</section>

{{-- STATS --}}
<section class="relative -mt-16 z-20">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['count' => '8', 'suffix' => '+', 'label' => 'Années d\'expertise'],
                ['count' => '4', 'suffix' => '', 'label' => 'Sites au Bénin'],
                ['count' => '500', 'suffix' => '+', 'label' => 'Produits disponibles'],
                ['count' => '5', 'suffix' => '+', 'label' => 'Partenaires fabricants'],
            ] as $i => $stat)
                <div class="reveal delay-{{ $i + 1 }} bg-white rounded-2xl p-6 shadow-xl text-center">
                    <p class="text-3xl lg:text-4xl font-bold text-accent" data-count="{{ $stat['count'] }}" data-suffix="{{ $stat['suffix'] }}">0</p>
                    <p class="text-sm text-steel mt-2">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- À PROPOS RAPIDE --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="reveal-left relative">
                @if(count($entrepriseImages) > 0)
                    <img src="{{ $entrepriseImages[0]['image'] }}" alt="Notre entreprise" class="w-full rounded-2xl shadow-2xl object-cover aspect-[4/3]" />
                @else
                    <div class="w-full aspect-[4/3] rounded-2xl bg-gradient-to-br from-sand to-sand-dark flex items-center justify-center">
                        <span class="text-steel-light text-lg">Photo de l'entreprise</span>
                    </div>
                @endif
                <div class="absolute -bottom-6 -right-6 bg-accent text-white p-6 rounded-2xl shadow-xl hidden sm:block animate-float">
                    <p class="text-3xl font-bold">2017</p>
                    <p class="text-sm text-white/80">Fondée au Bénin</p>
                </div>
            </div>

            <div class="reveal">
                <span class="inline-block px-4 py-1.5 bg-accent/10 text-accent rounded-full text-sm font-semibold mb-4">Qui sommes-nous</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-6 leading-tight">
                    Un acteur majeur du <span class="text-accent">BTP au Bénin</span>
                </h2>
                <p class="text-steel text-lg mb-6 leading-relaxed">
                    {{ $infos['description'] ?? 'ADENIKE-INTER SARL est une société spécialisée dans la commercialisation des matériaux de construction et la réalisation de projets BTP. Nous nous approvisionnons directement auprès des fabricants pour garantir qualité et prix compétitifs.' }}
                </p>
                <a href="{{ route('apropos') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-primary-light text-white rounded-xl font-semibold transition-all hover:-translate-y-0.5">
                    En savoir plus
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES --}}
<section class="py-24 bg-primary">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-accent/20 text-accent rounded-full text-sm font-semibold mb-4">Nos services</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Une offre complète</h2>
            <p class="text-steel-light max-w-2xl mx-auto">Du matériel de construction à la réalisation clé en main de vos projets.</p>
        </div>
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach([
        [
            'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4',
            'titre' => 'Matériaux de construction',
            'desc' => 'Ciment, fer à béton, tôle, bois et divers matériaux disponibles directement auprès des fabricants.'
        ],

        [
            'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
            'titre' => 'Construction BTP',
            'desc' => 'Construction de maisons, bâtiments administratifs, infrastructures publiques, routes pavées, routes en terre et travaux de voirie.'
        ],

        [
            'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35',
            'titre' => 'Quincaillerie générale',
            'desc' => 'Plomberie, menuiserie, outillage, visserie, équipements de sécurité et accessoires divers.'
        ],

        [
            'icon' => 'M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0',
            'titre' => 'Livraison sur chantier',
            'desc' => 'Transport rapide et sécurisé grâce à notre flotte de camions pour tous vos sites.'
        ],

        [
            'icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'titre' => 'Import international',
            'desc' => 'Promotion des produits locaux et importation de matériaux de qualité depuis plusieurs marchés internationaux.'
        ],

        [
            'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z',
            'titre' => 'Esquisse gratuite',
            'desc' => 'Bénéficiez gratuitement d’une première esquisse de votre projet avec des conseils techniques adaptés à vos besoins.'
        ],

    ] as $i => $s)

        <div class="reveal delay-{{ ($i % 3) + 1 }} group p-8 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-accent/30 transition-all duration-500 hover:-translate-y-1">
            
            <div class="w-14 h-14 rounded-xl bg-accent/15 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/>
                </svg>
            </div>

            <h3 class="text-lg font-bold text-white mb-3">
                {{ $s['titre'] }}
            </h3>

            <p class="text-sm text-steel-light leading-relaxed">
                {{ $s['desc'] }}
            </p>

        </div>

    @endforeach
</div>
    </div>
</section>

{{-- PRODUITS VEDETTES (depuis API) --}}
@if(count($produitImages) > 0)
<section class="py-24 bg-sand">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-16">
            <span class="inline-block px-4 py-1.5 bg-accent/10 text-accent rounded-full text-sm font-semibold mb-4">Nos produits</span>
            <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-4">Matériaux en vedette</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($produitImages as $i => $img)
                <div class="reveal delay-{{ ($i % 4) + 1 }} group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                    <div class="relative aspect-square overflow-hidden bg-gray-100">
                        <img src="{{ $img['image'] }}" alt="{{ $img['titre'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy" />
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-primary group-hover:text-accent transition-colors">{{ $img['titre'] }}</h3>
                        @if($img['description'] ?? false)
                            <p class="text-sm text-steel mt-1 line-clamp-2">{{ $img['description'] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="reveal text-center mt-12">
            <a href="{{ route('produits') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-accent hover:bg-accent-dark text-white rounded-xl font-semibold transition-all">
                Voir tous nos produits
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- PARTENAIRES --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-12">
            <span class="inline-block px-4 py-1.5 bg-accent/10 text-accent rounded-full text-sm font-semibold mb-4">
                Nos partenaires
            </span>
            <h2 class="text-3xl font-bold text-primary mb-2">
                Approvisionnement direct fabricants
            </h2>
        </div>

        @php
            $partenaires = [
                ['nom' => 'NOCIBE — Ciment', 'logo' => 'assets/nocibe.jpg'],
                ['nom' => 'FMB — Fer à béton', 'logo' => 'assets/fmb.png'],
                ['nom' => 'SIAB — Fer à béton, Tôles & Pointes', 'logo' => 'assets/siab.webp'],
                ['nom' => 'SBS — Fer à béton', 'logo' => 'assets/sbs.webp'],
                ['nom' => 'IBP — Plomberie', 'logo' => 'assets/ibp.webp'],
                ['nom' => 'Sonimex — Fer à béton', 'logo' => 'assets/sonimex.png'],

            ];
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($partenaires as $i => $p)
                <div class="reveal delay-{{ $i + 1 }} bg-sand rounded-xl p-6 text-center hover:shadow-lg transition group">

                    <div class="w-20 h-20 flex items-center justify-center mx-auto mb-3">
                        <img 
                            src="{{ asset($p['logo']) }}" 
                            alt="{{ $p['nom'] }}" 
                            class="max-h-16 object-contain group-hover:scale-110 transition"
                        >
                    </div>

                    <p class="text-sm font-semibold text-primary">
                        {{ $p['nom'] }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-24 bg-gradient-to-r from-accent to-accent-dark">
    <div class="max-w-4xl mx-auto px-6 text-center reveal">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Prêt à démarrer votre projet ?</h2>
        <p class="text-white/80 mb-8 text-lg">Particulier, entrepreneur ou grande entreprise — nous avons ce qu'il vous faut.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="inline-flex items-center gap-3 px-10 py-4 bg-white text-accent rounded-xl font-bold text-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                WhatsApp
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-10 py-4 bg-transparent text-white border-2 border-white/40 rounded-xl font-bold text-lg hover:bg-white/10 transition-all">
                Nous contacter
            </a>
        </div>
    </div>
</section>

@endsection