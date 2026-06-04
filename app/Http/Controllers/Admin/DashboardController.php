<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageVitrine;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => ImageVitrine::count(),
            'actives' => ImageVitrine::actives()->count(),
            'hero' => ImageVitrine::where('categorie', 'hero')->count(),
            'produit' => ImageVitrine::where('categorie', 'produit')->count(),
            'entreprise' => ImageVitrine::where('categorie', 'entreprise')->count(),
            'equipe' => ImageVitrine::where('categorie', 'equipe')->count(),
            'service' => ImageVitrine::where('categorie', 'service')->count(),
        ];

        $recentes = ImageVitrine::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentes'));
    }
}