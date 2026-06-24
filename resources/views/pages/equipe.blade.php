@extends('layouts.app')

@section('title', 'Notre équipe — ' . ($infos['nom_societe'] ?? 'ADENIKE-INTER'))
@section('description', 'Découvrez l\'équipe d\'ADENIKE-INTER SARL, des professionnels engagés pour vous servir.')
@section('keywords', 'équipe ADENIKE-INTER, magasiniers, personnel BTP Bénin')

@section('content')

<section class="pt-32 pb-20 bg-primary">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block px-4 py-1.5 bg-accent/20 text-accent rounded-full text-sm font-semibold mb-4">Notre équipe</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Les hommes & femmes derrière ADENIKE</h1>
        <p class="text-steel-light max-w-2xl mx-auto text-lg">Une équipe passionnée et engagée à votre service chaque jour.</p>
    </div>
</section>

<section class="py-24 bg-sand">
    <div class="max-w-7xl mx-auto px-6">
        @if($membres->count())
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($membres as $i => $m)
            <div class="reveal delay-{{ ($i % 4) + 1 }} group text-center">
                <div class="aspect-square rounded-2xl overflow-hidden bg-sand-dark mb-4 shadow-sm group-hover:shadow-xl transition-all duration-300">
                    @if($m->photo_url)
                        <img src="{{ $m->photo_url }}" alt="{{ $m->nom }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-steel-light">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                    @endif
                </div>
                <h3 class="font-bold text-primary text-base">{{ $m->nom }}</h3>
                <p class="text-accent text-sm font-semibold mt-0.5">{{ $m->poste }}</p>
                @if($m->description)
                    <p class="text-steel text-xs mt-2 leading-relaxed px-2">{{ $m->description }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 text-steel">
            <p>L'équipe sera bientôt présentée.</p>
        </div>
        @endif
    </div>
</section>

<section class="py-16 bg-gradient-to-r from-accent to-accent-dark">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-2xl lg:text-3xl font-bold text-white mb-4">Rejoindre notre équipe ?</h2>
        <p class="text-white/80 mb-6">Nous sommes toujours à la recherche de talents motivés.</p>
        @php
            $whatsapp = preg_replace('/\D/', '', $infos['whatsapp'] ?? $infos['telephone'] ?? '');
        @endphp
        <a href="https://wa.me/{{ $whatsapp }}"
           target="_blank"
           class="inline-flex items-center gap-3 px-10 py-4 bg-white text-accent rounded-xl font-bold text-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
            Nous contacter
        </a>
    </div>
</section>

@endsection