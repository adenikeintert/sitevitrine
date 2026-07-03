@extends('layouts.app')
@section('title', ($infos['nom_societe'] ?? 'ADENIKE-INTER') . ' — Matériaux de construction & BTP au Bénin')

@php
    $whatsapp = preg_replace('/\D/', '', $infos['whatsapp'] ?? $infos['telephone'] ?? '22901664427031');
@endphp

{{--
    NOTE POLICES : ce design utilise Oswald (titres, style "lettrage chantier" condensé)
    + Inter (texte courant, déjà probablement chargé). Si Oswald n'est pas encore chargée
    dans layouts.app, ajoute dans le <head> :
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500;600;700&display=swap" rel="stylesheet">
--}}

@section('content')
@include('partials.schema')

{{-- ============================================================
     HERO — panneau contenu + visuel en biais, règle graduée signature
     ============================================================ --}}
<section class="relative bg-primary overflow-hidden">

    {{-- Règle graduée verticale (signature visuelle) — visible dès sm --}}
    <div class="hidden sm:flex absolute left-0 top-0 bottom-0 w-8 lg:w-10 z-30 flex-col items-center bg-accent/95">
        <div class="flex-1 w-full relative">
            @for ($i = 0; $i < 20; $i++)
                <div class="absolute left-0 w-full flex items-center" style="top: {{ $i * 5 }}%;">
                    <div class="{{ $i % 2 === 0 ? 'w-full h-[2px]' : 'w-1/2 h-px' }} bg-white/70"></div>
                    @if($i % 4 === 0 && $i > 0)
                        <span class="absolute left-1/2 -translate-x-1/2 -translate-y-1/2 text-[9px] font-bold text-white/80 tracking-tight">{{ $i * 5 }}</span>
                    @endif
                </div>
            @endfor
        </div>
        <div class="py-3 border-t border-white/30 [writing-mode:vertical-rl] text-[10px] tracking-[0.25em] text-white font-semibold uppercase">
            Adenike
        </div>
    </div>

    <div class="grid lg:grid-cols-[minmax(0,560px)_1fr] min-h-[640px] lg:min-h-[720px]">

        {{-- COLONNE CONTENU --}}
        <div class="relative z-20 flex items-center pl-8 sm:pl-16 lg:pl-16 pr-6 sm:pr-10 py-20 lg:py-0">
            <div class="max-w-xl">

                {{-- BADGE type "fiche technique" --}}
                <div class="inline-flex items-center gap-2 pl-2 pr-4 py-1.5 mb-7 border border-accent/40 rounded-sm">
                    <span class="px-2 py-0.5 bg-accent text-primary text-[11px] font-bold tracking-wide">DEPUIS 2017</span>
                    <span class="text-white/70 text-xs sm:text-sm font-medium">
                        {{ $infos['nom_societe'] ?? 'ADENIKE-INTER' }} — Bénin
                    </span>
                </div>

                {{-- TEXT SLIDER (hooks JS conservés à l'identique) --}}
                <div class="relative min-h-[190px] sm:min-h-[220px] mb-8">
                    @foreach($heroImages as $i => $slide)
                        <div class="hero-text absolute left-0 top-0 w-full transition-all duration-700
                            {{ $i === 0 ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-6 pointer-events-none' }}">

                            <h1 class="font-['Oswald',sans-serif] uppercase text-3xl sm:text-4xl lg:text-[2.75rem] font-bold text-white leading-[1.08] tracking-tight mb-5">
                                {{ $slide['titre'] ?? 'Matériaux de construction' }}
                            </h1>

                            <p class="text-sm sm:text-base text-white/65 leading-relaxed max-w-md">
                                {{ $slide['description'] ?? 'Qualité, fiabilité et expertise au service de vos ambitions.' }}
                            </p>
                        </div>
                    @endforeach
                </div>

                {{-- BOUTONS --}}
                <div class="flex flex-wrap items-center gap-3 mb-8">
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center gap-2 px-7 py-3.5 bg-accent hover:bg-accent-dark text-white font-bold text-sm uppercase tracking-wide transition-all hover:-translate-y-0.5"
                       style="clip-path: polygon(0 0, 100% 0, 100% 70%, 92% 100%, 0 100%);">
                        Demander un devis
                    </a>

                    <a href="tel:{{ $infos['telephone'] ?? '' }}"
                       class="inline-flex items-center gap-2 px-6 py-3.5 border border-white/25 hover:border-white/50 text-white font-semibold text-sm transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        Appeler
                    </a>

                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                       class="inline-flex items-center justify-center w-12 h-12 bg-[#25D366] hover:brightness-105 text-white transition-all"
                       aria-label="WhatsApp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.46 1.32 4.96L2 22l5.25-1.38a9.9 9.9 0 004.79 1.22h.01c5.46 0 9.9-4.45 9.9-9.91C21.96 6.45 17.5 2 12.04 2zm0 18.05h-.01a8.2 8.2 0 01-4.19-1.15l-.3-.18-3.11.82.83-3.03-.2-.31a8.19 8.19 0 01-1.26-4.36c0-4.54 3.7-8.24 8.25-8.24 4.54 0 8.23 3.7 8.23 8.24 0 4.55-3.69 8.21-8.24 8.21z"/></svg>
                    </a>
                </div>

                {{-- LIGNE DE CONFIANCE type "fiche mesures" --}}
                <div class="flex flex-wrap gap-x-6 gap-y-2 text-white/60 text-xs sm:text-sm font-medium">
                    <span class="flex items-center gap-1.5"><span class="w-1 h-1 rounded-full bg-accent"></span>500+ produits</span>
                    <span class="flex items-center gap-1.5"><span class="w-1 h-1 rounded-full bg-accent"></span>5 partenaires fabricants</span>
                    <span class="flex items-center gap-1.5"><span class="w-1 h-1 rounded-full bg-accent"></span>Livraison sur chantier</span>
                </div>
            </div>
        </div>

        {{-- COLONNE VISUEL, découpe en biais + repères de plan --}}
        <div class="relative min-h-[320px] lg:min-h-0"
             style="clip-path: polygon(6% 0, 100% 0, 100% 100%, 0 100%);">

            @if(count($heroImages) > 0)
                @foreach($heroImages as $i => $slide)
                    <div class="hero-slide absolute inset-0 transition-all duration-1000 {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}">
                        <img src="{{ $slide['image'] }}" alt="{{ $slide['titre'] ?? '' }}" class="w-full h-full object-cover" />
                    </div>
                @endforeach
            @endif

            <div class="absolute inset-0 bg-gradient-to-t from-primary/70 via-primary/10 to-transparent lg:bg-gradient-to-r lg:from-primary/40 lg:via-transparent lg:to-transparent"></div>

            {{-- Repères d'angle façon plan technique --}}
            <svg class="hidden lg:block absolute top-8 right-8 w-10 h-10 text-white/70" viewBox="0 0 40 40" fill="none">
                <path d="M2 14V2H14" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            <svg class="hidden lg:block absolute bottom-8 right-8 w-10 h-10 text-white/70" viewBox="0 0 40 40" fill="none">
                <path d="M2 26V38H14" stroke="currentColor" stroke-width="1.5"/>
            </svg>

            {{-- DOTS --}}
            @if(count($heroImages) > 1)
                <div class="absolute bottom-6 right-8 lg:right-14 z-30 flex gap-2">
                    @foreach($heroImages as $i => $s)
                        <button class="hero-dot h-1.5 rounded-full transition-all duration-500
                            {{ $i === 0 ? 'w-8 bg-accent' : 'w-4 bg-white/40' }}">
                        </button>
                    @endforeach
                </div>

                <button id="heroPrev"
                    class="hidden sm:flex absolute left-6 top-1/2 -translate-y-1/2 z-30 items-center justify-center w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button id="heroNext"
                    class="hidden sm:flex absolute right-6 top-1/2 -translate-y-1/2 z-30 items-center justify-center w-10 h-10 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </button>
            @endif
        </div>
    </div>

    {{-- Repère scroll --}}
    <div class="hidden lg:flex absolute bottom-6 left-1/2 -translate-x-1/2 z-30 flex-col items-center gap-1 text-white/40">
        <span class="text-[10px] tracking-[0.3em] uppercase">Découvrir</span>
        <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</section>

{{-- STATS — cartes façon plaques d'acier --}}
<section class="relative -mt-14 z-20">
    <div class="max-w-6xl mx-auto px-6 sm:px-10 lg:px-16">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['count' => '8', 'suffix' => '+', 'label' => 'Années d\'expertise'],
                ['count' => '4', 'suffix' => '', 'label' => 'Sites au Bénin'],
                ['count' => '500', 'suffix' => '+', 'label' => 'Produits disponibles'],
                ['count' => '5', 'suffix' => '+', 'label' => 'Partenaires fabricants'],
            ] as $i => $stat)
                <div class="reveal delay-{{ $i + 1 }} relative bg-white shadow-xl text-center p-6"
                     style="clip-path: polygon(0 0, 100% 0, 100% 100%, 12px 100%, 0 calc(100% - 12px));">
                    <p class="font-['Oswald',sans-serif] text-3xl lg:text-4xl font-bold text-accent" data-count="{{ $stat['count'] }}" data-suffix="{{ $stat['suffix'] }}">0</p>
                    <p class="text-xs sm:text-sm text-steel mt-2 font-medium">{{ $stat['label'] }}</p>
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
                    <div class="relative" style="clip-path: polygon(0 0, 100% 0, 100% 92%, 90% 100%, 0 100%);">
                        <img src="{{ $entrepriseImages[0]['image'] }}" alt="Notre entreprise" class="w-full shadow-2xl object-cover aspect-[4/3]" />
                    </div>
                @else
                    <div class="w-full aspect-[4/3] bg-gradient-to-br from-sand to-sand-dark flex items-center justify-center">
                        <span class="text-steel-light text-lg">Photo de l'entreprise</span>
                    </div>
                @endif
                <div class="absolute -bottom-6 -right-6 bg-accent text-white p-6 shadow-xl hidden sm:block">
                    <p class="font-['Oswald',sans-serif] text-3xl font-bold">2017</p>
                    <p class="text-sm text-white/80">Fondée au Bénin</p>
                </div>
            </div>

            <div class="reveal">
                <span class="inline-flex items-center gap-2 mb-4">
                    <span class="w-6 h-px bg-accent"></span>
                    <span class="text-accent text-xs font-bold uppercase tracking-widest">Qui sommes-nous</span>
                </span>
                <h2 class="font-['Oswald',sans-serif] uppercase text-3xl lg:text-4xl font-bold text-primary mb-6 leading-tight">
                    Un acteur majeur du <span class="text-accent">BTP au Bénin</span>
                </h2>
                <p class="text-steel text-lg mb-6 leading-relaxed">
                    {{ $infos['description'] ?? 'ADENIKE-INTER SARL est une société spécialisée dans la commercialisation des matériaux de construction et la réalisation de projets BTP. Nous nous approvisionnons directement auprès des fabricants pour garantir qualité et prix compétitifs.' }}
                </p>
                <a href="{{ route('apropos') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary hover:bg-primary-light text-white font-semibold transition-all hover:-translate-y-0.5">
                    En savoir plus
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES --}}
<section class="py-24 bg-primary relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="reveal text-center mb-16">
            <span class="inline-flex items-center gap-2 justify-center mb-4">
                <span class="w-6 h-px bg-accent"></span>
                <span class="text-accent text-xs font-bold uppercase tracking-widest">Nos services</span>
                <span class="w-6 h-px bg-accent"></span>
            </span>
            <h2 class="font-['Oswald',sans-serif] uppercase text-3xl lg:text-4xl font-bold text-white mb-4">Une offre complète</h2>
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
                    'desc' => 'Bénéficiez gratuitement d\'une première esquisse de votre projet avec des conseils techniques adaptés à vos besoins.'
                ],
            ] as $i => $s)
                <div class="reveal delay-{{ ($i % 3) + 1 }} group relative p-8 bg-white/5 border border-white/10 hover:bg-white/[0.08] hover:border-accent/30 transition-all duration-500">
                    <span class="absolute top-3 right-3 text-[10px] font-mono text-white/20 group-hover:text-accent/50 transition-colors">{{ sprintf('%02d', $i + 1) }}</span>

                    <div class="w-14 h-14 bg-accent/15 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform"
                         style="clip-path: polygon(0 0, 100% 0, 100% 75%, 75% 100%, 0 100%);">
                        <svg class="w-7 h-7 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/>
                        </svg>
                    </div>

                    <h3 class="font-['Oswald',sans-serif] uppercase text-lg font-bold text-white mb-3 tracking-wide">
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

{{-- PRODUITS VEDETTES --}}
@if(count($produitImages) > 0)
<section class="py-24 bg-sand">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-16">
            <span class="inline-flex items-center gap-2 justify-center mb-4">
                <span class="w-6 h-px bg-accent"></span>
                <span class="text-accent text-xs font-bold uppercase tracking-widest">Nos produits</span>
                <span class="w-6 h-px bg-accent"></span>
            </span>
            <h2 class="font-['Oswald',sans-serif] uppercase text-3xl lg:text-4xl font-bold text-primary mb-4">Matériaux en vedette</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($produitImages as $i => $img)
                <div class="reveal delay-{{ ($i % 4) + 1 }} group bg-white overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                    <div class="relative aspect-square overflow-hidden bg-gray-100">
                        <img src="{{ $img['image'] }}" alt="{{ $img['titre'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy" />
                    </div>
                    <div class="p-5 border-t-2 border-accent/0 group-hover:border-accent transition-colors">
                        <h3 class="font-bold text-primary group-hover:text-accent transition-colors">{{ $img['titre'] }}</h3>
                        @if($img['description'] ?? false)
                            <p class="text-sm text-steel mt-1 line-clamp-2">{{ $img['description'] }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <div class="reveal text-center mt-12">
            <a href="{{ route('produits') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-accent hover:bg-accent-dark text-white font-semibold transition-all">
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
            <span class="inline-flex items-center gap-2 justify-center mb-4">
                <span class="w-6 h-px bg-accent"></span>
                <span class="text-accent text-xs font-bold uppercase tracking-widest">Nos partenaires</span>
                <span class="w-6 h-px bg-accent"></span>
            </span>
            <h2 class="font-['Oswald',sans-serif] uppercase text-2xl sm:text-3xl font-bold text-primary mb-2">
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
                <div class="reveal delay-{{ $i + 1 }} bg-sand p-6 text-center hover:shadow-lg transition group">
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
<section class="relative py-24 bg-accent overflow-hidden">
    <div class="hidden lg:block absolute inset-y-0 right-0 w-1/3 bg-accent-dark" style="clip-path: polygon(30% 0, 100% 0, 100% 100%, 0 100%);"></div>
    <div class="max-w-4xl mx-auto px-6 text-center reveal relative z-10">
        <h2 class="font-['Oswald',sans-serif] uppercase text-3xl lg:text-4xl font-bold text-white mb-4">Prêt à démarrer votre projet ?</h2>
        <p class="text-white/80 mb-8 text-lg">Particulier, entrepreneur ou grande entreprise — nous avons ce qu'il vous faut.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="inline-flex items-center gap-3 px-10 py-4 bg-white text-accent font-bold text-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.46 1.32 4.96L2 22l5.25-1.38a9.9 9.9 0 004.79 1.22h.01c5.46 0 9.9-4.45 9.9-9.91C21.96 6.45 17.5 2 12.04 2zm0 18.05h-.01a8.2 8.2 0 01-4.19-1.15l-.3-.18-3.11.82.83-3.03-.2-.31a8.19 8.19 0 01-1.26-4.36c0-4.54 3.7-8.24 8.25-8.24 4.54 0 8.23 3.7 8.23 8.24 0 4.55-3.69 8.21-8.24 8.21z"/></svg>
                WhatsApp
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-10 py-4 bg-transparent text-white border-2 border-white/40 font-bold text-lg hover:bg-white/10 transition-all">
                Nous contacter
            </a>
        </div>
    </div>
</section>

@endsection