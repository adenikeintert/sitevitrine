<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('categorie')->orderBy('ordre')->get();
        return view('admin.produits.index', compact('produits'));
    }

    public function create()
    {
        $categories = Categorie::actives()->orderBy('ordre')->get();
        return view('admin.produits.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:4096',
            'actif' => 'nullable|boolean',
        ]);

        $data['slug'] = Str::slug($data['nom']) . '-' . Str::random(5);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produits', 'public');
        }

        Produit::create($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit créé.');
    }

    public function edit(Produit $produit)
    {
        $categories = Categorie::actives()->orderBy('ordre')->get();
        return view('admin.produits.edit', compact('produit', 'categories'));
    }

    public function update(Request $request, Produit $produit)
    {
        $data = $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:4096',
            'actif' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('produits', 'public');
        }

        $produit->update($data);

        return redirect()->route('admin.produits.index')->with('success', 'Produit mis à jour.');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return back()->with('success', 'Produit supprimé.');
    }
}