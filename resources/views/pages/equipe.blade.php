@extends('layouts.app')

@section('title', 'Notre équipe — ' . ($infos['nom_societe'] ?? 'ADENIKE-INTER'))
@section('description', 'Découvrez l\'équipe d\'ADENIKE-INTER SARL, des professionnels engagés pour vous servir.')
@section('keywords', 'équipe ADENIKE-INTER, magasiniers, personnel BTP Bénin')

@section('content')

{{-- BANNIÈRE --}}
<section class="relative pt-36 pb-20 bg-primary overflow-hidden">
    <div class="hidden lg:block absolute inset-y-0 right-0 w-1/3 bg-primary-light" style="clip-path: polygon(35% 0, 100% 0, 100% 100%, 0 100%);"></div>
    <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center gap-2 pl-2 pr-4 py-1.5 mb-6 border border-accent/40 rounded-sm">
            <span class="px-2 py-0.5 bg-accent text-white text-[11px] font-bold tracking-wide">SUR LE TERRAIN</span>
            <span class="text-white/70 text-xs sm:text-sm font-medium">Notre équipe</span>
        </div>
        <h1 class="font-['Oswald',sans-serif] uppercase text-4xl lg:text-5xl font-bold text-white mb-4">Au travail, chaque jour</h1>
        <p class="text-steel-light max-w-2xl mx-auto text-lg">Une équipe passionnée et engagée à votre service.</p>
    </div>
</section>

{{-- MUR DE PHOTOS — MOSAÏQUE --}}
<section class="py-20 bg-sand">
    <div class="max-w-7xl mx-auto px-6">
        @if($membres->count())
        <div class="columns-2 sm:columns-3 lg:columns-4 gap-4 space-y-4">
            @foreach($membres as $i => $m)
                @if($m->photo_url)
                <button type="button"
                        onclick="openGalleryLightbox({{ $i }})"
                        data-src="{{ $m->photo_url }}"
                        class="reveal delay-{{ ($i % 4) + 1 }} team-photo group relative block w-full overflow-hidden break-inside-avoid mb-4 bg-sand-dark shadow-sm hover:shadow-xl transition-all duration-300"
                        style="clip-path: polygon(0 0, 100% 0, 100% 100%, 10px 100%, 0 calc(100% - 10px));">
                    <img src="{{ $m->photo_url }}" alt="" class="w-full h-auto object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                    <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/10 transition-colors duration-300"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="w-9 h-9 bg-white/90 flex items-center justify-center">
                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                        </span>
                    </div>
                </button>
                @endif
            @endforeach
        </div>
        @else
        <div class="text-center py-20 text-steel">
            <p>Les photos de l'équipe seront bientôt disponibles.</p>
        </div>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="relative py-16 bg-accent overflow-hidden">
    <div class="hidden lg:block absolute inset-y-0 right-0 w-1/3 bg-accent-dark" style="clip-path: polygon(30% 0, 100% 0, 100% 100%, 0 100%);"></div>
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="font-['Oswald',sans-serif] uppercase text-2xl lg:text-3xl font-bold text-white mb-4">Rejoindre notre équipe ?</h2>
        <p class="text-white/80 mb-6">Nous sommes toujours à la recherche de talents motivés.</p>
        @php
            $whatsapp = preg_replace('/\D/', '', $infos['whatsapp'] ?? $infos['telephone'] ?? '');
        @endphp
        <a href="https://wa.me/{{ $whatsapp }}"
           target="_blank"
           class="inline-flex items-center gap-3 px-10 py-4 bg-white text-accent font-bold text-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
            Nous contacter
        </a>
    </div>
</section>

{{-- LIGHTBOX --}}
<div id="teamLightbox" class="fixed inset-0 z-[100] bg-primary/95 backdrop-blur-sm hidden items-center justify-center px-4">
    <button onclick="closeGalleryLightbox()" class="absolute top-5 right-5 w-11 h-11 flex items-center justify-center text-white hover:text-accent transition">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    <button onclick="galleryNav(-1)" class="hidden sm:flex absolute left-5 top-1/2 -translate-y-1/2 w-11 h-11 items-center justify-center bg-white/10 hover:bg-white/20 text-white transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button onclick="galleryNav(1)" class="hidden sm:flex absolute right-5 top-1/2 -translate-y-1/2 w-11 h-11 items-center justify-center bg-white/10 hover:bg-white/20 text-white transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>
    <img id="teamLightboxImg" src="" alt="" class="max-h-[85vh] max-w-full object-contain shadow-2xl">
</div>

<script>
let galleryPhotos = [];
let galleryIndex = 0;

document.addEventListener('DOMContentLoaded', () => {
    galleryPhotos = Array.from(document.querySelectorAll('.team-photo')).map(el => el.dataset.src);
});

function openGalleryLightbox(index) {
    galleryIndex = index;
    updateGalleryLightbox();
    const lb = document.getElementById('teamLightbox');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeGalleryLightbox() {
    const lb = document.getElementById('teamLightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}

function galleryNav(dir) {
    galleryIndex = (galleryIndex + dir + galleryPhotos.length) % galleryPhotos.length;
    updateGalleryLightbox();
}

function updateGalleryLightbox() {
    document.getElementById('teamLightboxImg').src = galleryPhotos[galleryIndex];
}

document.addEventListener('keydown', (e) => {
    if (document.getElementById('teamLightbox').classList.contains('hidden')) return;
    if (e.key === 'Escape') closeGalleryLightbox();
    if (e.key === 'ArrowLeft') galleryNav(-1);
    if (e.key === 'ArrowRight') galleryNav(1);
});
</script>

@endsection