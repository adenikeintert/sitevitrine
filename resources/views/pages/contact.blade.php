@extends('layouts.app')
@section('title', 'Contact — ' . ($infos['nom_societe'] ?? 'ADENIKE-INTER'))

@php
    $tel = $infos['telephone'] ?? '(+229)  66 44 27 31';
    $tel2 = '(+229)  63 45 97 44';
    $email = $infos['email'] ?? 'adenikeinter@gmail.com';
    $adresse = $infos['adresse'] ?? 'Porto-Novo, Bénin';
    $whatsapp = preg_replace('/\D/', '', $infos['whatsapp'] ?? $infos['telephone'] ?? '229664427031');
@endphp

@section('content')

<section class="pt-32 pb-20 bg-primary">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block px-4 py-1.5 bg-accent/20 text-accent rounded-full text-sm font-semibold mb-4">Contact</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Contactez-nous</h1>
        <p class="text-steel-light max-w-2xl mx-auto text-lg">Notre équipe est disponible pour répondre à toutes vos questions.</p>
    </div>
</section>

{{-- INFOS CONTACT --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            @foreach([
                ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'titre' => 'Téléphone', 'lignes' => [$tel, $tel2]],
                ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'titre' => 'Email', 'lignes' => [$email, 'adenikeinter0@gmail.com']],
                ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'titre' => 'Horaires', 'lignes' => ['Lun-Ven : 08h00-18h00', 'Sam : 08h00-15h00']],
                ['icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'titre' => 'WhatsApp', 'lignes' => [$tel, $tel2]],
            ] as $i => $c)
                <div class="reveal delay-{{ $i + 1 }} bg-sand rounded-2xl p-6 text-center group hover:shadow-lg transition-all">
                    <div class="w-14 h-14 rounded-2xl bg-accent/10 flex items-center justify-center mx-auto mb-4 group-hover:bg-accent group-hover:scale-110 transition-all">
                        <svg class="w-6 h-6 text-accent group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $c['icon'] }}"/></svg>
                    </div>
                    <h3 class="font-bold text-primary mb-2">{{ $c['titre'] }}</h3>
                    @foreach($c['lignes'] as $l)
                        <p class="text-sm text-steel">{{ $l }}</p>
                    @endforeach
                </div>
            @endforeach
        </div>
{{-- NOS SITES --}}
<div class="reveal">
    <h2 class="text-2xl font-bold text-primary mb-8 text-center">
        Nos sites au Bénin
    </h2>

    <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4">
        @foreach([
            [
                'site' => 'Porto-Novo',
                'ville' => 'Ouémé',
                'link' => 'https://www.google.com/maps/search/Porto-Novo+Benin'
            ],
            [
                'site' => 'Avrankou',
                'ville' => 'Ouémé',
                'link' => 'https://www.google.com/maps/search/Avrankou+Benin'
            ],
            [
                'site' => 'Dangbo',
                'ville' => 'Ouémé',
                'link' => 'https://www.google.com/maps/search/Dangbo+Benin'
            ],
            [
                'site' => 'Abomey-Calavi',
                'ville' => 'Atlantique',
                'link' => 'https://www.google.com/maps/search/Abomey-Calavi+Benin'
            ],
            [
                'site' => 'Adjarra (en construction)',
                'ville' => 'Ouémé',
                'link' => 'https://www.google.com/maps/search/Adjarra+Benin'
            ],
        ] as $i => $s)

            <a href="{{ $s['link'] }}"
               target="_blank"
               class="block delay-{{ $i + 1 }} bg-white rounded-xl p-6 border border-gray-100 hover:border-accent/30 hover:shadow-lg transition-all text-center hover:-translate-y-1">

                <div class="w-10 h-10 rounded-lg bg-accent/10 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                </div>

                <h4 class="font-bold text-primary">{{ $s['site'] }}</h4>
                <p class="text-sm text-steel">{{ $s['ville'] }}</p>
            </a>

        @endforeach
    </div>
</div>
    </div>
</section>

{{-- CTA WHATSAPP --}}
<section class="py-16 bg-gradient-to-r from-green-600 to-emerald-700">
    <div class="max-w-4xl mx-auto px-6 text-center reveal">
        <svg class="w-12 h-12 mx-auto mb-4 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
        <h2 class="text-2xl lg:text-3xl font-bold text-white mb-3">Écrivez-nous sur WhatsApp</h2>
        <p class="text-white/80 mb-6 max-w-lg mx-auto">Envoyez votre liste de matériaux et recevez votre devis en quelques minutes.</p>
        <a href="https://wa.me/{{ $whatsapp }}" target="_blank" class="inline-flex items-center gap-3 px-10 py-4 bg-white text-green-700 rounded-xl font-bold text-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
            Envoyer un message
        </a>
    </div>
</section>

@endsection