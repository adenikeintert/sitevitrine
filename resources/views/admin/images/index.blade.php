@extends('admin.layouts.app')
@section('title', 'Images vitrine')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Images vitrine</h1>
            <p class="text-gray-500 mt-1">Gérez toutes les images affichées sur votre site public</p>
        </div>
        <button onclick="openModal()" class="px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-700 hover:from-emerald-600 hover:to-emerald-800 text-white font-semibold rounded-xl shadow-lg shadow-emerald-500/30 transition hover:-translate-y-0.5 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Ajouter une image
        </button>
    </div>

    {{-- Stats par catégorie --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 mb-6">
        @foreach($stats['par_cat'] as $key => $cat)
            <a href="?categorie={{ $key }}" class="bg-white rounded-xl p-4 border border-gray-100 hover:border-emerald-300 hover:shadow-sm transition">
                <p class="text-xs text-gray-500 uppercase font-semibold tracking-wide">{{ $cat['label'] }}</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $cat['count'] }}</p>
            </a>
        @endforeach
    </div>

    {{-- Filtres --}}
    <form method="GET" class="bg-white rounded-2xl border border-gray-100 p-4 mb-6 flex flex-col sm:flex-row gap-3">
        <div class="flex-1 relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..."
                class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
        </div>
        <select name="categorie" onchange="this.form.submit()"
            class="px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
            <option value="all" {{ request('categorie') === 'all' || !request('categorie') ? 'selected' : '' }}>Toutes catégories</option>
            @foreach($categories as $k => $l)
                <option value="{{ $k }}" {{ request('categorie') === $k ? 'selected' : '' }}>{{ $l }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl text-sm font-semibold">Filtrer</button>
    </form>

    {{-- Grille d'images --}}
    @if($images->count() === 0)
        <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <p class="text-gray-500">Aucune image trouvée</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($images as $img)
                <div class="group bg-white rounded-2xl border {{ $img->actif ? 'border-gray-100' : 'border-red-200 opacity-60' }} overflow-hidden hover:shadow-xl hover:-translate-y-1 transition-all">
                    <div class="relative aspect-[4/3] bg-gray-100 overflow-hidden">
                        <img src="{{ $img->image_url }}" alt="{{ $img->titre }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        {{-- Overlay actions --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition">
                            <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between">
                                <div class="flex gap-1.5">
                                    <button onclick='openEditModal(@json($img))' class="p-2 bg-white rounded-lg text-emerald-600 hover:bg-emerald-50">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <form method="POST" action="{{ route('admin.images.destroy', $img) }}" onsubmit="return confirm('Supprimer cette image ?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button class="p-2 bg-white rounded-lg text-red-600 hover:bg-red-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                                <div class="flex gap-1.5">
                                    <form method="POST" action="{{ route('admin.images.order', $img) }}" class="inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="direction" value="up">
                                        <button class="p-2 bg-white rounded-lg text-gray-600 hover:bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.images.order', $img) }}" class="inline">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="direction" value="down">
                                        <button class="p-2 bg-white rounded-lg text-gray-600 hover:bg-gray-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Badge catégorie --}}
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 rounded-lg text-xs font-semibold bg-white/90 backdrop-blur text-gray-700">
                                {{ $categories[$img->categorie] ?? $img->categorie }}
                            </span>
                        </div>

                        {{-- Badge ordre --}}
                        <div class="absolute top-3 right-3">
                            <span class="w-7 h-7 flex items-center justify-center rounded-full bg-black/50 text-white text-xs font-bold backdrop-blur">{{ $img->ordre }}</span>
                        </div>

                        @if(!$img->actif)
                            <div class="absolute inset-0 bg-red-500/10 flex items-center justify-center">
                                <span class="px-3 py-1.5 bg-red-600 text-white rounded-lg text-xs font-bold uppercase">Masquée</span>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <div class="flex items-start justify-between gap-2">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 text-sm truncate">{{ $img->titre }}</h3>
                                @if($img->description)
                                    <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $img->description }}</p>
                                @endif
                            </div>
                            <form method="POST" action="{{ route('admin.images.toggle', $img) }}" class="inline">
                                @csrf @method('PATCH')
                                <button class="p-1.5 rounded-lg {{ $img->actif ? 'text-emerald-600' : 'text-gray-400' }}">
                                    @if($img->actif)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- MODAL AJOUT / ÉDITION --}}
<div id="imageModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 p-5 flex items-center justify-between">
            <div>
                <h3 id="modalTitle" class="text-xl font-bold text-white">Ajouter une image</h3>
                <p class="text-emerald-100 text-sm mt-1">Cette image sera visible sur le site vitrine</p>
            </div>
            <button type="button" onclick="closeModal()" class="p-2 hover:bg-white/20 rounded-lg transition">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="imageForm" method="POST" enctype="multipart/form-data" class="flex-1 overflow-y-auto p-5 space-y-5">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Image <span class="text-red-500">*</span></label>
                <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewImg(event)"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                <img id="imagePreview" class="mt-3 max-h-48 rounded-xl hidden">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Titre <span class="text-red-500">*</span></label>
                <input type="text" name="titre" id="inputTitre" required
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Description</label>
                <textarea name="description" id="inputDescription" rows="2"
                    class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Catégorie</label>
                    <select name="categorie" id="inputCategorie"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                        @foreach($categories as $k => $l)
                            <option value="{{ $k }}">{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 uppercase tracking-wide mb-2">Ordre</label>
                    <input type="number" name="ordre" id="inputOrdre" value="0" min="0"
                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 outline-none text-sm">
                </div>
            </div>

            <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl cursor-pointer">
                <input type="checkbox" name="actif" id="inputActif" value="1" checked class="w-4 h-4 text-emerald-600 rounded">
                <span class="text-sm font-medium text-gray-700">Visible sur le site</span>
            </label>
        </form>

        <div class="bg-gray-50 p-5 border-t border-gray-200 flex gap-3">
            <button type="button" onclick="closeModal()" class="flex-1 py-3 bg-white border border-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-50">Annuler</button>
            <button type="submit" form="imageForm" class="flex-1 py-3 bg-gradient-to-r from-emerald-500 to-emerald-700 text-white rounded-xl font-semibold shadow-lg shadow-emerald-500/30">Enregistrer</button>
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modalTitle').textContent = 'Ajouter une image';
    document.getElementById('imageForm').action = '{{ route("admin.images.store") }}';
    document.getElementById('formMethod').value = 'POST';
    document.getElementById('imageForm').reset();
    document.getElementById('imagePreview').classList.add('hidden');
    document.getElementById('imageInput').required = true;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
}

function openEditModal(img) {
    document.getElementById('modalTitle').textContent = "Modifier l'image";
    document.getElementById('imageForm').action = '/admin/images/' + img.id;
    document.getElementById('formMethod').value = 'PUT';
    document.getElementById('inputTitre').value = img.titre || '';
    document.getElementById('inputDescription').value = img.description || '';
    document.getElementById('inputCategorie').value = img.categorie;
    document.getElementById('inputOrdre').value = img.ordre;
    document.getElementById('inputActif').checked = img.actif;
    document.getElementById('imageInput').required = false;
    const preview = document.getElementById('imagePreview');
    preview.src = img.image_url;
    preview.classList.remove('hidden');
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
}

function previewImg(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        const img = document.getElementById('imagePreview');
        img.src = ev.target.result;
        img.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
}
</script>
@endsection