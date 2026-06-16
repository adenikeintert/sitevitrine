{{-- $categories doit être disponible, $selectedId optionnel (édition) --}}
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3" id="category-cards">
    @foreach($categories as $cat)
    <label class="category-card cursor-pointer">
        <input type="radio" name="categorie_id" value="{{ $cat->id }}"
               {{ (old('categorie_id', $selectedId ?? null) == $cat->id) ? 'checked' : '' }}
               class="hidden" required onchange="updateCategorySelection(this)">
        <div class="rounded-xl border-2 border-gray-200 bg-white overflow-hidden transition-all duration-200 hover:border-emerald-300 hover:shadow-md card-inner">
            <div class="aspect-square bg-gray-50 relative">
                @if($cat->image_url)
                    <img src="{{ $cat->image_url }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                @endif
                <div class="check-badge absolute top-1.5 right-1.5 w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center opacity-0 transition-opacity">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
            <p class="text-center text-xs font-medium text-gray-700 py-2 px-1 truncate">{{ $cat->nom }}</p>
        </div>
    </label>
    @endforeach
</div>

<style>
.category-card input:checked + .card-inner {
    border-color: #10b981;
    box-shadow: 0 0 0 3px rgba(16,185,129,.15);
    background: #f0fdf9;
}
.category-card input:checked + .card-inner .check-badge { opacity: 1; }
</style>

<script>
function updateCategorySelection(input) {
    // Pas de logique JS nécessaire au-delà du CSS :checked, gardé pour extension future
}
</script>