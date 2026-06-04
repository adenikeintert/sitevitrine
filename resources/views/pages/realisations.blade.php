@extends('layouts.app')
@section('title', 'Nos réalisations — ' . ($infos['nom_societe'] ?? 'ADENIKE-INTER'))

@section('content')

<section class="pt-32 pb-20 bg-primary">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="inline-block px-4 py-1.5 bg-accent/20 text-accent rounded-full text-sm font-semibold mb-4">Portfolio</span>
        <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">Nos réalisations</h1>
        <p class="text-steel-light max-w-2xl mx-auto text-lg">Découvrez nos projets de construction et nos sites au Bénin.</p>
    </div>
</section>

{{-- PROJETS --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        @foreach([
            ['titre' => 'Complexe Scolaire « La Madone »', 'desc' => 'Reconstruction complète d\'un complexe scolaire — de la démolition à la livraison.', 'tag' => 'Construction publique'],
            ['titre' => 'Magasin de Tanzoun — Porto-Novo', 'desc' => 'Construction et aménagement d\'un magasin de vente de matériaux de construction.', 'tag' => 'Infrastructure commerciale'],
            ['titre' => 'Magasin de Dangbo', 'desc' => 'Construction d\'un grand espace de stockage et vente, en face de l\'IMSP.', 'tag' => 'Infrastructure commerciale'],
            ['titre' => 'Maisons résidentielles', 'desc' => 'Construction de plusieurs maisons modernes et durables adaptées aux besoins des clients.', 'tag' => 'Résidentiel'],
        ] as $i => $projet)
            <div class="reveal mb-16 {{ $i % 2 === 0 ? '' : '' }}">
                <div class="flex items-center gap-4 mb-6">
                    <span class="px-3 py-1 bg-accent/10 text-accent text-xs font-semibold rounded-full">{{ $projet['tag'] }}</span>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>
                <h3 class="text-2xl font-bold text-primary mb-3">{{ $projet['titre'] }}</h3>
                <p class="text-steel mb-6 max-w-2xl">{{ $projet['desc'] }}</p>
            </div>
        @endforeach
    </div>
</section>

{{-- GALERIE RÉALISATIONS (depuis API) --}}
@if(count($serviceImages) > 0)
<section class="py-24 bg-sand">
    <div class="max-w-7xl mx-auto px-6">
        <div class="reveal text-center mb-16">
            <h2 class="text-3xl font-bold text-primary mb-4">Galerie photos</h2>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($serviceImages as $i => $img)
                <div class="reveal delay-{{ ($i % 3) + 1 }} group rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ $img['image'] }}" alt="{{ $img['titre'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy" />
                    </div>
                    @if($img['titre'] ?? false)
                        <div class="p-4 bg-white">
                            <p class="font-semibold text-primary text-sm">{{ $img['titre'] }}</p>
                            @if($img['description'] ?? false)
                                <p class="text-xs text-steel mt-1">{{ $img['description'] }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-16 bg-gradient-to-r from-accent to-accent-dark">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-2xl lg:text-3xl font-bold text-white mb-4">Vous avez un projet de construction ?</h2>
        <p class="text-white/80 mb-6">Confiez-nous votre projet et bénéficiez de notre expertise.</p>
        <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-10 py-4 bg-white text-accent rounded-xl font-bold text-lg hover:shadow-xl hover:-translate-y-0.5 transition-all">
            Discutons de votre projet
        </a>
    </div>
</section>

@endsection