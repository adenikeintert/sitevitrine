@extends('layouts.app')
@section('title', 'Nos produits — ' . ($infos['nom_societe'] ?? 'ADENIKE-INTER'))

@section('content')

{{-- BANNIÈRE --}}
<section class="relative pt-36 pb-20 bg-primary overflow-hidden">
    <div class="hidden lg:block absolute inset-y-0 right-0 w-1/3 bg-primary-light" style="clip-path: polygon(35% 0, 100% 0, 100% 100%, 0 100%);"></div>
    <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
        <div class="inline-flex items-center gap-2 pl-2 pr-4 py-1.5 mb-6 border border-accent/40 rounded-sm">
            <span class="px-2 py-0.5 bg-accent text-white text-[11px] font-bold tracking-wide">CATALOGUE</span>
            <span class="text-white/70 text-xs sm:text-sm font-medium">500+ références</span>
        </div>
        <h1 class="font-['Oswald',sans-serif] uppercase text-4xl lg:text-5xl font-bold text-white mb-4">Nos produits</h1>
        <p class="text-steel-light max-w-2xl mx-auto text-lg">Matériaux de construction, quincaillerie et outillage.</p>
    </div>
</section>

{{-- FILTRES CATÉGORIES --}}
@if($categories->count())
<section class="py-6 bg-white sticky top-0 z-30 border-b border-sand-dark/60 backdrop-blur">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex gap-2 overflow-x-auto pb-1 no-scrollbar">
            <button onclick="filterCategorie('all', this)"
                    class="filter-btn active flex-shrink-0 px-5 py-2.5 text-sm font-semibold border-b-2 border-accent text-accent transition-all whitespace-nowrap">
                Tous
            </button>
            @foreach($categories as $cat)
                <button onclick="filterCategorie('{{ $cat->slug }}', this)"
                        class="filter-btn flex-shrink-0 px-5 py-2.5 text-sm font-semibold border-b-2 border-transparent text-steel hover:text-accent hover:border-accent/40 transition-all whitespace-nowrap">
                    {{ $cat->nom }}
                </button>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- PRODUITS — GALERIE PHOTO --}}
<section class="py-20 bg-sand">
    <div class="max-w-7xl mx-auto px-6 space-y-20">
        @forelse($categories as $cat)
            @if($cat->produits->count())
            <div class="categorie-section" data-slug="{{ $cat->slug }}">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-12 h-12 bg-accent/10 flex items-center justify-center overflow-hidden flex-shrink-0"
                         style="clip-path: polygon(0 0, 100% 0, 100% 75%, 75% 100%, 0 100%);">
                        @if($cat->image_url)
                            <img src="{{ $cat->image_url }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        @endif
                    </div>
                    <div>
                        <h2 class="font-['Oswald',sans-serif] uppercase text-2xl lg:text-3xl font-bold text-primary leading-none">{{ $cat->nom }}</h2>
                        <span class="text-xs text-steel tracking-wide">{{ $cat->produits->count() }} article{{ $cat->produits->count() > 1 ? 's' : '' }}</span>
                    </div>
                    <span class="flex-1 h-px bg-sand-dark ml-2"></span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    @foreach($cat->produits as $i => $p)
                        @php
                            // Si une relation "images" existe et contient plusieurs photos, on l'utilise.
                            // Sinon on retombe sur l'image unique du produit.
                            $galerie = (isset($p->images) && $p->images->count())
                                ? $p->images->pluck('url')->filter()->values()
                                : collect([$p->image_url])->filter()->values();
                            $galerieJson = $galerie->toJson();
                            $nbPhotos = $galerie->count();
                        @endphp

                        <button type="button"
                                onclick='openLightbox({{ $galerieJson }}, 0)'
                                class="reveal delay-{{ ($i % 5) + 1 }} group relative block w-full aspect-square overflow-hidden bg-sand-dark/30 text-left"
                                style="clip-path: polygon(0 0, 100% 0, 100% 100%, 10px 100%, 0 calc(100% - 10px));">

                            @if($galerie->isNotEmpty())
                                <img src="{{ $galerie->first() }}" alt="Produit" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-steel-light">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                            @endif

                            {{-- overlay au survol : prix + zoom, jamais de nom --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/0 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-3">
                                @if($p->prix)
                                    <span class="text-white font-bold text-sm">{{ number_format($p->prix, 0, ',', ' ') }} FCFA</span>
                                @endif
                            </div>

                            {{-- badge nombre de photos --}}
                            @if($nbPhotos > 1)
                                <span class="absolute top-2 right-2 flex items-center gap-1 px-2 py-1 bg-primary/70 backdrop-blur-sm text-white text-[10px] font-semibold">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $nbPhotos }}
                                </span>
                            @endif

                            {{-- icône loupe centrale au survol --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="w-9 h-9 bg-white/90 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                                </span>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
            @endif
        @empty
            <div class="text-center py-20 text-steel">
                <p>Le catalogue sera bientôt disponible.</p>
            </div>
        @endforelse
    </div>
</section>

{{-- CTA --}}
<section class="relative py-16 bg-accent overflow-hidden">
    <div class="hidden lg:block absolute inset-y-0 right-0 w-1/3 bg-accent-dark" style="clip-path: polygon(30% 0, 100% 0, 100% 100%, 0 100%);"></div>
    <div class="max-w-4xl mx-auto px-6 text-center relative z-10">
        <h2 class="font-['Oswald',sans-serif] uppercase text-2xl lg:text-3xl font-bold text-white mb-4">
            Besoin d'un produit spécifique ?
        </h2>
        <p class="text-white/80 mb-6">
            Envoyez-nous votre liste de matériaux et recevez rapidement une facture proforma personnalisée.
        </p>
        @php
            $whatsapp = preg_replace('/\D/', '', $infos['whatsapp'] ?? $infos['telephone'] ?? '22901664427031');
        @endphp
        <a href="https://wa.me/{{ $whatsapp }}"
           target="_blank"
           class="inline-flex items-center gap-3 px-10 py-4 bg-white text-accent font-bold text-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
            Demander un proforma
        </a>
    </div>
</section>

{{-- LIGHTBOX --}}
<div id="lightbox" class="fixed inset-0 z-[100] bg-primary/95 backdrop-blur-sm hidden items-center justify-center px-4">
    <button onclick="closeLightbox()" class="absolute top-5 right-5 w-11 h-11 flex items-center justify-center text-white hover:text-accent transition">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>

    <button onclick="lightboxNav(-1)" id="lightboxPrev" class="hidden sm:flex absolute left-5 top-1/2 -translate-y-1/2 w-11 h-11 items-center justify-center bg-white/10 hover:bg-white/20 text-white transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button onclick="lightboxNav(1)" id="lightboxNext" class="hidden sm:flex absolute right-5 top-1/2 -translate-y-1/2 w-11 h-11 items-center justify-center bg-white/10 hover:bg-white/20 text-white transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>

    <img id="lightboxImg" src="" alt="" class="max-h-[85vh] max-w-full object-contain shadow-2xl">

    <div id="lightboxCounter" class="absolute bottom-6 left-1/2 -translate-x-1/2 text-white/70 text-sm font-medium tracking-wide"></div>
</div>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
function filterCategorie(slug, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => {
        b.classList.remove('active', 'text-accent', 'border-accent');
        b.classList.add('text-steel', 'border-transparent');
    });
    btn.classList.add('active', 'text-accent', 'border-accent');
    btn.classList.remove('text-steel', 'border-transparent');

    document.querySelectorAll('.categorie-section').forEach(sec => {
        sec.style.display = (slug === 'all' || sec.dataset.slug === slug) ? '' : 'none';
    });
}

let lightboxImages = [];
let lightboxIndex = 0;

function openLightbox(images, index) {
    lightboxImages = Array.isArray(images) ? images : [images];
    lightboxIndex = index;
    updateLightbox();
    document.getElementById('lightbox').classList.remove('hidden');
    document.getElementById('lightbox').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    document.getElementById('lightbox').classList.add('hidden');
    document.getElementById('lightbox').classList.remove('flex');
    document.body.style.overflow = '';
}

function lightboxNav(dir) {
    lightboxIndex = (lightboxIndex + dir + lightboxImages.length) % lightboxImages.length;
    updateLightbox();
}

function updateLightbox() {
    document.getElementById('lightboxImg').src = lightboxImages[lightboxIndex];
    const multi = lightboxImages.length > 1;
    document.getElementById('lightboxPrev').style.display = multi ? '' : 'none';
    document.getElementById('lightboxNext').style.display = multi ? '' : 'none';
    document.getElementById('lightboxCounter').textContent = multi ? (lightboxIndex + 1) + ' / ' + lightboxImages.length : '';
}

document.addEventListener('keydown', (e) => {
    if (document.getElementById('lightbox').classList.contains('hidden')) return;
    if (e.key === 'Escape') closeLightbox();
    if (e.key === 'ArrowLeft') lightboxNav(-1);
    if (e.key === 'ArrowRight') lightboxNav(1);
});
</script>

@endsection