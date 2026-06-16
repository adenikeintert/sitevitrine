@extends('admin.layouts.app')
@section('title', 'Nouveau produit')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('admin.produits.index') }}" class="text-sm text-gray-400 hover:text-gray-600 flex items-center gap-1 mb-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Retour aux produits
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Nouveau produit</h1>
    </div>

    <form action="{{ route('admin.produits.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
            <h2 class="text-sm font-semibold text-gray-900 mb-1">Catégorie</h2>
            <p class="text-xs text-gray-400 mb-4">Sélectionne la catégorie du produit en cliquant sur une carte.</p>
            @include('admin.produits.partials._category-cards', ['categories' => $categories])
            @error('categorie_id')<p class="text-red-500 text-xs mt-2">{{ $message }}</p>@enderror
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
            <h2 class="text-sm font-semibold text-gray-900 mb-1">Informations</h2>

            <div>
                <label class="text-sm font-medium text-gray-700">Nom du produit</label>
                <input type="text" name="nom" value="{{ old('nom') }}" required
                       class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-400">
                @error('nom')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4"
                          class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-400">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-sm font-medium text-gray-700">Prix (FCFA)</label>
                    <input type="number" step="0.01" name="prix" value="{{ old('prix') }}"
                           class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2.5 text-sm focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-400">
                </div>
                <div class="flex items-end">
                    <label class="flex items-center gap-2 text-sm text-gray-700 pb-2.5">
                        <input type="checkbox" name="actif" value="1" checked class="rounded"> Visible sur le site
                    </label>
                </div>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Image du produit</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full mt-1 text-sm rounded-lg border-gray-200 border px-3 py-2 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:bg-emerald-50 file:text-emerald-700 file:text-xs file:font-medium">
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.produits.index') }}" class="flex-1 text-center py-3 rounded-xl border border-gray-200 text-sm font-medium text-gray-600">Annuler</a>
            <button type="submit" class="flex-1 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold shadow-lg shadow-emerald-500/20">Enregistrer le produit</button>
        </div>
    </form>
</div>
@endsection