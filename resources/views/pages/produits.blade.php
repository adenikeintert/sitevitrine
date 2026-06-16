@extends('layouts.app')
@section('title', 'Nos produits — ' . ($infos['nom_societe'] ?? 'ADENIKE-INTER'))

@section('content')

<section class="pt-32 pb-20 bg-primary">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block px-4 py-1.5 bg-accent/20 text-accent rounded-full text-sm font-semibold mb-4">Catalogue</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Nos produits</h1>
        <p class="text-steel-light max-w-2xl mx-auto text-lg">Matériaux de construction, quincaillerie et outillage.</p>
    </div>
</section>

{{-- FILTRES CATÉGORIES --}}
@if($categories->count())
<section class="py-10 bg-white sticky top-0 z-30 border-b border-sand-dark/60 backdrop-blur">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex gap-3 overflow-x-auto pb-1 no-scrollbar">
            <button onclick="filterCategorie('all', this)"
                    class="filter-btn active flex-shrink-0 px-5 py-2.5 rounded-full text-sm font-semibold border border-accent bg-accent text-white transition-all">
                Tous
            </button>
            @foreach($categories as $cat)
                <button onclick="filterCategorie('{{ $cat->slug }}', this)"
                        class="filter-btn flex-shrink-0 px-5 py-2.5 rounded-full text-sm font-semibold border border-sand-dark text-primary hover:border-accent transition-all">
                    {{ $cat->nom }}
                </button>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- PRODUITS GROUPÉS PAR CATÉGORIE --}}
<section class="py-20 bg-sand">
    <div class="max-w-7xl mx-auto px-6 space-y-20">
        @forelse($categories as $cat)
            @if($cat->produits->count())
            <div class="categorie-section" data-slug="{{ $cat->slug }}">
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center overflow-hidden flex-shrink-0">
                        @if($cat->image_url)
                            <img src="{{ $cat->image_url }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        @endif
                    </div>
                    <h2 class="text-2xl lg:text-3xl font-bold text-primary">{{ $cat->nom }}</h2>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
                    @foreach($cat->produits as $i => $p)
                        <div class="reveal delay-{{ ($i % 5) + 1 }} group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                            <div class="aspect-square overflow-hidden bg-sand-dark/30 relative">
                                @if($p->image_url)
                                    <img src="{{ $p->image_url }}" alt="{{ $p->nom }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-steel-light">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4 text-center">
                                <p class="text-sm font-bold text-primary truncate">{{ $p->nom }}</p>
                                @if($p->prix)
                                    <p class="text-accent font-semibold text-sm mt-1">{{ number_format($p->prix, 0, ',', ' ') }} FCFA</p>
                                @endif
                            </div>
                        </div>
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
<section class="py-16 bg-gradient-to-r from-accent to-accent-dark">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-2xl lg:text-3xl font-bold text-white mb-4">
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
           class="inline-flex items-center gap-3 px-10 py-4 bg-white text-accent rounded-xl font-bold text-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
            Demander un proforma
        </a>
    </div>
</section>

<style>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
function filterCategorie(slug, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => {
        b.classList.remove('active', 'bg-accent', 'text-white', 'border-accent');
        b.classList.add('text-primary', 'border-sand-dark');
    });
    btn.classList.add('active', 'bg-accent', 'text-white', 'border-accent');
    btn.classList.remove('text-primary', 'border-sand-dark');

    document.querySelectorAll('.categorie-section').forEach(sec => {
        if (slug === 'all' || sec.dataset.slug === slug) {
            sec.style.display = '';
        } else {
            sec.style.display = 'none';
        }
    });
}
</script>

@endsection