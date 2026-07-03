@php
    $tel = $infos['telephone'] ?? '(+229) 01 66 44 27 31';
    $email = $infos['email'] ?? 'adenikeinter@gmail.com';
    $whatsapp = preg_replace('/\D/', '', $infos['whatsapp'] ?? $infos['telephone'] ?? '22901664427031');
    $nom = $infos['nom_societe'] ?? 'ADENIKE-INTER SARL';
    $logo = $infos['logo'] ?? null;
    $horaires = $infos['horaires'] ?? 'Lun - Ven : 08h00 - 18h00 | Sam : 08h00 - 15h00';
    $isHome = request()->routeIs('accueil');
@endphp

<div class="hidden lg:block bg-primary text-white/60 text-xs py-2 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <span class="flex items-center gap-1.5">
                <svg class="w-3 h-3 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                {{ $tel }}
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-3 h-3 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                {{ $email }}
            </span>
        </div>
        <span class="tracking-wide">{{ $horaires }}</span>
    </div>
</div>

<header id="header" class="fixed top-0 lg:top-8 left-0 right-0 z-50 transition-all duration-500 [&.scrolled]:bg-white/95 [&.scrolled]:backdrop-blur-xl [&.scrolled]:shadow-lg [&.scrolled]:lg:top-0 {{ $isHome ? 'bg-transparent' : 'bg-white shadow-sm lg:top-0' }}">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <a href="{{ route('accueil') }}" class="flex items-center gap-2.5">
                @if($logo)
                    <img src="{{ $logo }}" alt="{{ $nom }}" class="h-10 lg:h-12 w-auto" />
                @else
                    <div class="w-10 h-10 bg-accent flex items-center justify-center" style="clip-path: polygon(0 0, 100% 0, 100% 75%, 75% 100%, 0 100%);">
                        <span class="text-white font-bold text-lg">A</span>
                    </div>
                    <div class="font-['Oswald',sans-serif]">
                        <span class="text-lg font-bold tracking-wide {{ $isHome ? 'text-white [header.scrolled_&]:text-primary' : 'text-primary' }}">ADENIKE</span>
                        <span class="text-lg font-bold tracking-wide text-accent">-INTER</span>
                    </div>
                @endif
            </a>

            <nav class="hidden lg:flex items-center gap-1">
                @foreach([
                    ['route' => 'accueil', 'label' => 'Accueil'],
                    ['route' => 'apropos', 'label' => 'À propos'],
                    ['route' => 'produits', 'label' => 'Produits'],
                    ['route' => 'realisations', 'label' => 'Réalisations'],
                    ['route' => 'contact', 'label' => 'Contact'],
                    ['route' => 'equipe', 'label' => 'Équipe'],
                ] as $link)
                    <a href="{{ route($link['route']) }}"
                       class="relative px-4 py-2 text-sm font-medium transition-colors
                       {{ request()->routeIs($link['route'])
                           ? 'text-accent'
                           : ($isHome
                               ? 'text-white/80 hover:text-white [header.scrolled_&]:text-gray-600 [header.scrolled_&]:hover:text-accent'
                               : 'text-gray-600 hover:text-accent')
                       }}
                       after:content-[''] after:absolute after:left-4 after:right-4 after:-bottom-0.5 after:h-[2px] after:bg-accent after:transition-transform after:duration-300 after:origin-left
                       {{ request()->routeIs($link['route']) ? 'after:scale-x-100' : 'after:scale-x-0 hover:after:scale-x-100' }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach

                <a href="https://wa.me/{{ $whatsapp }}" target="_blank"
                   class="ml-4 inline-flex items-center gap-2 px-6 py-2.5 bg-accent hover:bg-accent-dark text-white text-sm font-semibold transition-all hover:-translate-y-0.5"
                   style="clip-path: polygon(0 0, 100% 0, 100% 65%, 88% 100%, 0 100%);">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="3.5"/>
                        <path d="M5 20c0-3.5 3.1-6 7-6s7 2.5 7 6"/>
                        <path d="M7 8.5a5 5 0 0 1 10 0"/>
                        <rect x="5.5" y="8" width="2.5" height="4" rx="1"/>
                        <rect x="16" y="8" width="2.5" height="4" rx="1"/>
                    </svg>
                    <span>Support client</span>
                </a>
            </nav>

            <button id="menuToggle" class="lg:hidden p-2 {{ $isHome ? 'text-white [header.scrolled_&]:text-primary' : 'text-primary' }}">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <div id="mobileMenu" class="lg:hidden bg-white border-t border-gray-100 shadow-xl hidden">
        <div class="px-6 py-4 space-y-1">
            @foreach(['accueil' => 'Accueil', 'apropos' => 'À propos', 'produits' => 'Produits', 'realisations' => 'Réalisations', 'contact' => 'Contact'] as $r => $l)
                <a href="{{ route($r) }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs($r) ? 'bg-accent/5 text-accent border-l-2 border-accent' : 'text-gray-700 hover:bg-accent/5 hover:text-accent border-l-2 border-transparent' }} font-medium transition-colors">{{ $l }}</a>
            @endforeach
        </div>
    </div>
</header>