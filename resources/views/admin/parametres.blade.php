@extends('admin.layouts.app')
@section('title', 'Paramètres')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Informations société</h1>
        <p class="text-gray-500 mt-1">Ces informations apparaissent sur le site vitrine public</p>
    </div>

    <form method="POST" action="{{ route('admin.parametres.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        {{-- Logo + Nom --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                <div class="w-1 h-5 bg-emerald-500 rounded-full"></div>
                Identité
            </h2>

            <div class="grid lg:grid-cols-3 gap-6">
                {{-- Logo --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Logo</label>
                    <div class="relative">
                        @if($parametre->logo)
                            <img src="{{ asset('storage/' . $parametre->logo) }}" alt="Logo" class="w-full aspect-square object-contain bg-gray-50 rounded-xl border border-gray-200 p-4">
                        @else
                            <div class="w-full aspect-square bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 flex items-center justify-center">
                                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <input type="file" name="logo" accept="image/*" class="mt-3 block w-full text-xs text-gray-500 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Nom de la société</label>
                        <input type="text" name="nom_societe" value="{{ old('nom_societe', $parametre->nom_societe) }}"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Slogan</label>
                        <input type="text" name="slogan" value="{{ old('slogan', $parametre->slogan) }}"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Année de création</label>
                            <input type="number" name="annee_creation" value="{{ old('annee_creation', $parametre->annee_creation) }}" min="1900" max="2100"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">RCCM</label>
                            <input type="text" name="rcm" value="{{ old('rcm', $parametre->rcm) }}"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">NIF / IFU</label>
                        <input type="text" name="nif" value="{{ old('nif', $parametre->nif) }}"
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Description de l'entreprise</label>
                <textarea name="description" rows="5"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">{{ old('description', $parametre->description) }}</textarea>
            </div>
        </div>

        {{-- Contact --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                <div class="w-1 h-5 bg-emerald-500 rounded-full"></div>
                Contact
            </h2>

            <div class="grid lg:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Téléphone principal</label>
                    <input type="text" name="telephone" value="{{ old('telephone', $parametre->telephone) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Téléphone secondaire</label>
                    <input type="text" name="telephone2" value="{{ old('telephone2', $parametre->telephone2) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">WhatsApp (sans +)</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $parametre->whatsapp) }}" placeholder="22901664427031"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Email principal</label>
                    <input type="email" name="email" value="{{ old('email', $parametre->email) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Email secondaire</label>
                    <input type="email" name="email2" value="{{ old('email2', $parametre->email2) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Horaires</label>
                    <input type="text" name="horaires" value="{{ old('horaires', $parametre->horaires) }}"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Adresse</label>
                <textarea name="adresse" rows="2"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">{{ old('adresse', $parametre->adresse) }}</textarea>
            </div>
        </div>

        {{-- Réseaux sociaux --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h2 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                <div class="w-1 h-5 bg-emerald-500 rounded-full"></div>
                Réseaux sociaux
            </h2>

            <div class="grid lg:grid-cols-2 gap-4">
                @foreach(['facebook' => 'Facebook', 'instagram' => 'Instagram', 'linkedin' => 'LinkedIn', 'twitter' => 'Twitter / X', 'youtube' => 'YouTube'] as $key => $label)
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">{{ $label }}</label>
                        <input type="url" name="{{ $key }}" value="{{ old($key, $parametre->$key) }}" placeholder="https://..."
                            class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Submit --}}
        <div class="flex justify-end gap-3 sticky bottom-6">
            <button type="submit"
                class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-700 hover:from-emerald-600 hover:to-emerald-800 text-white font-semibold rounded-xl shadow-lg shadow-emerald-500/30 transition hover:-translate-y-0.5 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection