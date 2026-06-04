<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parametre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ParametreController extends Controller
{
    public function edit()
    {
        $parametre = Parametre::instance();
        return view('admin.parametres', compact('parametre'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nom_societe' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'telephone' => 'nullable|string|max:50',
            'telephone2' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'email2' => 'nullable|email|max:255',
            'adresse' => 'nullable|string',
            'nif' => 'nullable|string|max:100',
            'rcm' => 'nullable|string|max:100',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'horaires' => 'nullable|string',
            'annee_creation' => 'nullable|integer|min:1900|max:2100',
            'slogan' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5120',
        ]);

        $parametre = Parametre::instance();

        // Upload du logo
        if ($request->hasFile('logo')) {
            if ($parametre->logo && !str_starts_with($parametre->logo, 'http')) {
                Storage::disk('public')->delete($parametre->logo);
            }
            $data['logo'] = $request->file('logo')->store('vitrine/logos', 'public');
        } else {
            unset($data['logo']);
        }

        $parametre->update($data);

        return back()->with('success', 'Paramètres enregistrés avec succès');
    }
}