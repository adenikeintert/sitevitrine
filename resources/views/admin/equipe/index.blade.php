@extends('admin.layouts.app')
@section('title', 'Équipe')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Équipe</h1>
            <p class="text-gray-500 text-sm mt-1">Gère les membres publiés sur la page équipe.</p>
        </div>
        <button onclick="document.getElementById('modal-create').classList.remove('hidden')"
                class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2.5 rounded-lg text-sm font-semibold shadow-lg shadow-emerald-500/20 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Ajouter un membre
        </button>
    </div>

    @if(session('success'))
        <div class="mb-6 px-4 py-3 bg-emerald-50 text-emerald-700 rounded-lg text-sm">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($membres as $m)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="aspect-square bg-gray-50 relative overflow-hidden">
                @if($m->photo_url)
                    <img src="{{ $m->photo_url }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                @endif
                @if(!$m->actif)
                    <span class="absolute top-2 right-2 bg-gray-900/80 text-white text-xs px-2 py-0.5 rounded-full">Masqué</span>
                @endif
            </div>
            <div class="p-3">
                <p class="font-semibold text-gray-900 text-sm truncate">{{ $m->nom }}</p>
                <p class="text-gray-400 text-xs mt-0.5 truncate">{{ $m->poste }}</p>
                <div class="flex gap-2 mt-3">
                    <button onclick="editMembre({{ $m->id }}, '{{ addslashes($m->nom) }}', '{{ addslashes($m->poste) }}', '{{ addslashes($m->description ?? '') }}', {{ $m->actif ? 'true' : 'false' }}, {{ $m->ordre }})"
                            class="flex-1 text-xs font-medium text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-lg py-1.5">Modifier</button>
                    <form action="{{ route('admin.equipe.destroy', $m) }}" method="POST" onsubmit="return confirm('Supprimer ce membre ?')">
                        @csrf @method('DELETE')
                        <button class="text-xs font-medium text-red-500 bg-red-50 hover:bg-red-100 rounded-lg py-1.5 px-3">Suppr.</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-16 text-gray-400">
            <p>Aucun membre pour le moment.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- Modal création --}}
<div id="modal-create" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md max-h-screen overflow-y-auto">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Nouveau membre</h2>
        <form action="{{ route('admin.equipe.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="text-sm font-medium text-gray-700">Nom complet</label>
                <input type="text" name="nom"  class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Poste</label>
                <input type="text" name="poste" required placeholder="ex: Magasinier, Responsable logistique..." class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Description courte</label>
                <textarea name="description" rows="2" class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Photo</label>
                <input type="file" name="photo" accept="image/*" class="w-full mt-1 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Ordre d'affichage</label>
                <input type="number" name="ordre" value="0" class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2 text-sm">
            </div>
            <label class="flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" name="actif" value="1" checked class="rounded"> Visible
            </label>
            <div class="flex gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')" class="flex-1 py-2.5 rounded-lg border border-gray-200 text-sm font-medium text-gray-600">Annuler</button>
                <button type="submit" class="flex-1 py-2.5 rounded-lg bg-emerald-600 text-white text-sm font-semibold">Ajouter</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal édition --}}
<div id="modal-edit" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 w-full max-w-md max-h-screen overflow-y-auto">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Modifier le membre</h2>
        <form id="form-edit" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="text-sm font-medium text-gray-700">Nom complet</label>
                <input type="text" name="nom" id="edit-nom" required class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Poste</label>
                <input type="text" name="poste" id="edit-poste" required class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Description courte</label>
                <textarea name="description" id="edit-description" rows="2" class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2 text-sm"></textarea>
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Nouvelle photo (optionnel)</label>
                <input type="file" name="photo" accept="image/*" class="w-full mt-1 text-sm">
            </div>
            <div>
                <label class="text-sm font-medium text-gray-700">Ordre d'affichage</label>
                <input type="number" name="ordre" id="edit-ordre" value="0" class="w-full mt-1 rounded-lg border-gray-200 border px-3 py-2 text-sm">
            </div>
            <label class="flex items-center gap-2 text-sm text-gray-700">
                <input type="checkbox" name="actif" id="edit-actif" value="1" class="rounded"> Visible
            </label>
            <div class="flex gap-2 pt-2">
                <button type="button" onclick="document.getElementById('modal-edit').classList.add('hidden')" class="flex-1 py-2.5 rounded-lg border border-gray-200 text-sm font-medium text-gray-600">Annuler</button>
                <button type="submit" class="flex-1 py-2.5 rounded-lg bg-emerald-600 text-white text-sm font-semibold">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<script>
function editMembre(id, nom, poste, description, actif, ordre) {
    document.getElementById('form-edit').action = `/admin/equipe/${id}`;
    document.getElementById('edit-nom').value = nom;
    document.getElementById('edit-poste').value = poste;
    document.getElementById('edit-description').value = description;
    document.getElementById('edit-actif').checked = actif;
    document.getElementById('edit-ordre').value = ordre;
    document.getElementById('modal-edit').classList.remove('hidden');
}
</script>
@endsection