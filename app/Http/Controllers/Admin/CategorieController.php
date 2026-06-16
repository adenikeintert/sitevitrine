<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::orderBy('ordre')->withCount('produits')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
            'actif' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['nom']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Categorie::create($data);

        return back()->with('success', 'Catégorie créée.');
    }

    public function update(Request $request, Categorie $categorie)
    {
        $data = $request->validate([
            'nom' => 'required|string|max:255',
            'image' => 'nullable|image|max:4096',
            'actif' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['nom']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $categorie->update($data);

        return back()->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }
}