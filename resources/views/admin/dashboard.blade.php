@extends('admin.layouts.app')
@section('title', 'Tableau de bord')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Bonjour, {{ auth()->user()->name }} 👋</h1>
        <p class="text-gray-500 mt-1">Voici un aperçu de votre site vitrine</p>
    </div>

    {{-- Cards stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['label' => 'Total images', 'value' => $stats['total'], 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'emerald'],
            ['label' => 'Actives', 'value' => $stats['actives'], 'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z', 'color' => 'blue'],
            ['label' => 'Hero / Slider', 'value' => $stats['hero'], 'icon' => 'M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z', 'color' => 'amber'],
            ['label' => 'Produits', 'value' => $stats['produit'], 'icon' => 'M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4', 'color' => 'rose'],
        ] as $card)
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-11 h-11 rounded-xl bg-{{ $card['color'] }}-50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-{{ $card['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/></svg>
                    </div>
                </div>
                <p class="text-3xl font-bold text-gray-900">{{ $card['value'] }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $card['label'] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Actions rapides --}}
    <div class="grid lg:grid-cols-3 gap-6 mb-8">
        <a href="{{ route('admin.images.index') }}" class="group bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl p-6 text-white shadow-lg shadow-emerald-500/20 hover:shadow-xl hover:-translate-y-1 transition-all">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                </div>
                <h3 class="font-bold text-lg">Ajouter une image</h3>
            </div>
            <p class="text-white/80 text-sm">Hero, produits, équipe, réalisations...</p>
        </a>

        <a href="{{ route('admin.parametres.edit') }}" class="group bg-white border border-gray-100 rounded-2xl p-6 hover:border-emerald-300 hover:shadow-lg transition-all">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg">Infos société</h3>
            </div>
            <p class="text-gray-500 text-sm">Téléphone, email, réseaux sociaux...</p>
        </a>

        <a href="{{ route('accueil') }}" target="_blank" class="group bg-white border border-gray-100 rounded-2xl p-6 hover:border-emerald-300 hover:shadow-lg transition-all">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </div>
                <h3 class="font-bold text-gray-900 text-lg">Voir le site</h3>
            </div>
            <p class="text-gray-500 text-sm">Ouvrir le site vitrine public</p>
        </a>
    </div>

    {{-- Images récentes --}}
    @if($recentes->count() > 0)
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-gray-900">Images récentes</h2>
            <a href="{{ route('admin.images.index') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">Tout voir →</a>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
            @foreach($recentes as $img)
                <div class="group relative aspect-square rounded-xl overflow-hidden bg-gray-100">
                    <img src="{{ $img->image_url }}" alt="{{ $img->titre }}" class="w-full h-full object-cover group-hover:scale-105 transition">
                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/80 to-transparent p-2">
                        <p class="text-white text-xs font-semibold truncate">{{ $img->titre }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection