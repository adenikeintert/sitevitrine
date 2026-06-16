@extends('admin.layouts.app')
@section('title', 'Produits')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Produits</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $produits->count() }} produit(s) enregistré(s).</p>
        </div>
        <a href="{{ route('admin.produits.create') }}"
           class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold shadow-lg shadow-emerald-500/20 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nouveau produit
        </a>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($produits as $p)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden group">
            <div class="aspect-square bg-gray-50 relative overflow-hidden">
                @if($p->image_url)
                    <img src="{{ $p->image_url }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
                @if(!$p->actif)
                    <span class="absolute top-2 right-2 bg-gray-900/80 text-white text-xs px-2 py-0.5 rounded-full">Masqué</span>
                @endif
                <span class="absolute top-2 left-2 bg-white/90 text-gray-700 text-xs px-2 py-0.5 rounded-full font-medium">{{ $p->categorie->nom ?? '—' }}</span>
            </div>
            <div class="p-3">
                <p class="font-semibold text-gray-900 text-sm truncate">{{ $p->nom }}</p>
                @if($p->prix)
                    <p class="text-emerald-600 text-sm font-bold mt-0.5">{{ number_format($p->prix, 0, ',', ' ') }} FCFA</p>
                @endif
                <div class="flex gap-2 mt-3">
                    <a href="{{ route('admin.produits.edit', $p) }}" class="flex-1 text-center text-xs font-medium text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-lg py-1.5">Modifier</a>
                    <form action="{{ route('admin.produits.destroy', $p) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                        @csrf @method('DELETE')
                        <button class="text-xs font-medium text-red-500 bg-red-50 hover:bg-red-100 rounded-lg py-1.5 px-3">Suppr.</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-gray-400">
            <p>Aucun produit pour le moment.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection