<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageVitrine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageVitrineController extends Controller
{
    public function index(Request $request)
    {
        $query = ImageVitrine::query();

        if ($request->filled('categorie') && $request->categorie !== 'all') {
            $query->where('categorie', $request->categorie);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('titre', 'like', "%{$s}%")
                  ->orWhere('description', 'like', "%{$s}%");
            });
        }

        $images = $query->orderBy('categorie')->orderBy('ordre')->get();
        $categories = ImageVitrine::categories();

        $stats = [
            'total' => ImageVitrine::count(),
            'actives' => ImageVitrine::actives()->count(),
            'par_cat' => collect($categories)->map(fn($l, $k) => [
                'label' => $l,
                'count' => ImageVitrine::where('categorie', $k)->count(),
            ])->toArray(),
        ];

        return view('admin.images.index', compact('images', 'categories', 'stats'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:200',
            'description' => 'nullable|string',
            'categorie' => 'required|in:hero,produit,entreprise,equipe,service',
            'ordre' => 'nullable|integer|min:0',
            'actif' => 'nullable|boolean',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $data['image'] = $request->file('image')->store('vitrine', 'public');
        $data['actif'] = $request->boolean('actif', true);
        $data['ordre'] = $data['ordre'] ?? 0;

        ImageVitrine::create($data);

        return back()->with('success', 'Image ajoutée avec succès');
    }

    public function update(Request $request, ImageVitrine $image)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:200',
            'description' => 'nullable|string',
            'categorie' => 'required|in:hero,produit,entreprise,equipe,service',
            'ordre' => 'nullable|integer|min:0',
            'actif' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        if ($request->hasFile('image')) {
            if ($image->image) {
                Storage::disk('public')->delete($image->image);
            }
            $data['image'] = $request->file('image')->store('vitrine', 'public');
        } else {
            unset($data['image']);
        }

        $data['actif'] = $request->boolean('actif', false);
        $image->update($data);

        return back()->with('success', 'Image modifiée avec succès');
    }

    public function toggle(ImageVitrine $image)
    {
        $image->update(['actif' => !$image->actif]);
        return back()->with('success', 'Visibilité modifiée');
    }

    public function order(Request $request, ImageVitrine $image)
    {
        $direction = $request->input('direction');
        $newOrdre = $direction === 'up' ? max(0, $image->ordre - 1) : $image->ordre + 1;
        $image->update(['ordre' => $newOrdre]);
        return back();
    }

    public function destroy(ImageVitrine $image)
    {
        $image->delete();
        return back()->with('success', 'Image supprimée');
    }
}