<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipe;
use Illuminate\Http\Request;

class EquipeController extends Controller
{
    public function index()
    {
        $membres = Equipe::orderBy('ordre')->get();
        return view('admin.equipe.index', compact('membres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => 'nullable|string|max:255',
            'poste' => 'required|string|max:255',
            'photo' => 'nullable|image|max:4096',
            'description' => 'nullable|string',
            'actif' => 'nullable|boolean',
            'ordre' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('equipe', 'public');
        }

        Equipe::create($data);

        return back()->with('success', 'Membre ajouté.');
    }

    public function update(Request $request, Equipe $equipe)
    {
        $data = $request->validate([
            'nom' => 'nullable|string|max:255',
            'poste' => 'required|string|max:255',
            'photo' => 'nullable|image|max:4096',
            'description' => 'nullable|string',
            'actif' => 'nullable|boolean',
            'ordre' => 'nullable|integer',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('equipe', 'public');
        }

        $equipe->update($data);

        return back()->with('success', 'Membre mis à jour.');
    }

    public function destroy(Equipe $equipe)
    {
        $equipe->delete();
        return back()->with('success', 'Membre supprimé.');
    }
}