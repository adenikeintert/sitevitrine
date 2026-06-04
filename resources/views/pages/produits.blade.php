@extends('layouts.app')
@section('title', 'Nos produits — ' . ($infos['nom_societe'] ?? 'ADENIKE-INTER'))

@section('content')

<section class="pt-32 pb-20 bg-primary">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block px-4 py-1.5 bg-accent/20 text-accent rounded-full text-sm font-semibold mb-4">Catalogue</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Nos produits</h1>
        <p class="text-steel-light max-w-2xl mx-auto text-lg">+500 références en matériaux de construction, quincaillerie et outillage.</p>
    </div>
</section>

{{-- CATÉGORIES --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-16">
            <h2 class="text-3xl font-bold text-primary mb-4">Nos catégories</h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['titre' => 'Maçonnerie', 'produits' => 'Ciment, fer à béton', 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4'],
                ['titre' => 'Plomberie', 'produits' => 'Tuyaux PVC, PPR, raccords, robinets, lavabos, WC, filtres', 'icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z'],
                ['titre' => 'Outillage', 'produits' => 'Marteaux, pelles, brouettes, niveaux, scies, pinces, burins', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35'],
                ['titre' => 'Couverture', 'produits' => 'Tôles ondulées, tôles bac, bande d\'étanchéité, toiturol', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['titre' => 'Sécurité', 'produits' => 'Casques, bottes, gants, gilets, cordes, cadenas', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'],
                ['titre' => 'Menuiserie & Serrurerie', 'produits' => 'Contreplaqués, charnières, poignées, serrures, clés', 'icon' => 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z'],
            ] as $i => $cat)
                <div class="reveal delay-{{ ($i % 3) + 1 }} bg-sand rounded-2xl p-8 hover:shadow-lg transition-all hover:-translate-y-1 group">
                    <div class="w-14 h-14 rounded-xl bg-accent/10 flex items-center justify-center mb-5 group-hover:bg-accent group-hover:scale-110 transition-all">
                        <svg class="w-7 h-7 text-accent group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $cat['icon'] }}"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-primary mb-2">{{ $cat['titre'] }}</h3>
                    <p class="text-sm text-steel leading-relaxed">{{ $cat['produits'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- GALERIE PRODUITS (depuis API) --}}
@if(count($produitImages) > 0)
<section class="py-24 bg-sand">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-16">
            <h2 class="text-3xl font-bold text-primary mb-4">Galerie produits</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($produitImages as $i => $img)
                <div class="reveal delay-{{ ($i % 5) + 1 }} group bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                    <div class="aspect-square overflow-hidden">
                        <img src="{{ $img['image'] }}" alt="{{ $img['titre'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
                    </div>
                    <div class="p-3 text-center">
                        <p class="text-xs font-semibold text-primary truncate">{{ $img['titre'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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

@endsection