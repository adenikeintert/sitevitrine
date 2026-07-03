@php
    $tel = $infos['telephone'] ?? '(+229) 01 66 44 27 31';
    $email = $infos['email'] ?? 'adenikeinter@gmail.com';
    $adresse = $infos['adresse'] ?? 'Porto-Novo, Bénin';
    $nom = $infos['nom_societe'] ?? 'ADENIKE-INTER SARL';
    $logo = $infos['logo'] ?? null;
    $whatsapp = preg_replace('/\D/', '', $infos['whatsapp'] ?? $infos['telephone'] ?? '22901664427031');
    $facebook = $infos['facebook'] ?? null;
    $slogan = $infos['slogan'] ?? 'Votre partenaire en matériaux de construction';
@endphp

<footer class="bg-primary text-white/70 relative">
    {{-- liseré graduation en haut, écho de la règle du hero --}}
    <div class="h-1.5 w-full flex">
        @for ($i = 0; $i < 40; $i++)
            <div class="flex-1 {{ $i % 5 === 0 ? 'bg-accent' : 'bg-accent/20' }} {{ $i % 5 === 0 ? '' : 'mx-px' }}"></div>
        @endfor
    </div>

    <div class="max-w-7xl mx-auto px-6 py-16">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-10">
            <div>
                @if($logo)
                    <img src="{{ $logo }}" alt="{{ $nom }}" class="h-12 w-auto mb-4" />
                @else
                    <div class="flex items-center gap-2.5 mb-4 font-['Oswald',sans-serif]">
                        <div class="w-10 h-10 bg-accent flex items-center justify-center" style="clip-path: polygon(0 0, 100% 0, 100% 75%, 75% 100%, 0 100%);">
                            <span class="text-white font-bold text-lg">A</span>
                        </div>
                        <div><span class="text-lg font-bold tracking-wide text-white">ADENIKE</span><span class="text-lg font-bold tracking-wide text-accent">-INTER</span></div>
                    </div>
                @endif
                <p class="text-sm leading-relaxed max-w-sm">
                    {{ $slogan }}
                </p>
                @if($facebook)
                    <div class="flex gap-3 mt-4">
                        <a href="{{ $facebook }}" target="_blank" class="w-9 h-9 bg-white/10 hover:bg-accent flex items-center justify-center transition">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                @endif
            </div>

            <div>
                <h4 class="font-['Oswald',sans-serif] text-white text-sm uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="w-4 h-px bg-accent"></span>Navigation
                </h4>
                <ul class="space-y-2">
                    @foreach(['accueil' => 'Accueil', 'apropos' => 'À propos', 'produits' => 'Produits', 'realisations' => 'Réalisations', 'contact' => 'Contact'] as $r => $l)
                        <li><a href="{{ route($r) }}" class="text-sm hover:text-accent transition">{{ $l }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="font-['Oswald',sans-serif] text-white text-sm uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="w-4 h-px bg-accent"></span>Nos sites
                </h4>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-center gap-2"><span class="w-1 h-1 bg-accent"></span>Porto-Novo</li>
                    <li class="flex items-center gap-2"><span class="w-1 h-1 bg-accent"></span>Avrankou</li>
                    <li class="flex items-center gap-2"><span class="w-1 h-1 bg-accent"></span>Dangbo</li>
                    <li class="flex items-center gap-2"><span class="w-1 h-1 bg-accent"></span>Abomey-Calavi</li>
                    <li class="flex items-center gap-2"><span class="w-1 h-1 bg-white/30"></span><span class="text-white/50">Adjarra (en construction)</span></li>
                </ul>
            </div>

            <div>
                <h4 class="font-['Oswald',sans-serif] text-white text-sm uppercase tracking-widest mb-4 flex items-center gap-2">
                    <span class="w-4 h-px bg-accent"></span>Contact
                </h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $tel }}
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-accent flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        {{ $email }}
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 text-accent mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $adresse }}
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs">
            <p>&copy; {{ date('Y') }} {{ $nom }}. Tous droits réservés.</p>
            {{-- <p>Propulsé par <a href="https://digitalbusinesscompany.pro" target="_blank" class="text-accent font-semibold hover:underline">ADK</a></p> --}}
        </div>
    </div>
</footer>