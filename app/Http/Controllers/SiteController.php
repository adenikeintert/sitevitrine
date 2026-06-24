<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use App\Models\ImageVitrine;
use App\Models\Categorie;
use App\Models\Equipe;

class SiteController extends Controller
{
    private function getInfos(): array
    {
        $p = Parametre::instance();
        return [
            'nom_societe' => $p->nom_societe,
            'description' => $p->description,
            'telephone' => $p->telephone,
            'telephone2' => $p->telephone2,
            'whatsapp' => $p->whatsapp ?: $p->telephone,
            'email' => $p->email,
            'email2' => $p->email2,
            'adresse' => $p->adresse,
            'logo' => $p->logo ? (str_starts_with($p->logo, 'http') ? $p->logo : asset('storage/' . $p->logo)) : null,
            'nif' => $p->nif,
            'rcm' => $p->rcm,
            'facebook' => $p->facebook,
            'instagram' => $p->instagram,
            'linkedin' => $p->linkedin,
            'twitter' => $p->twitter,
            'youtube' => $p->youtube,
            'horaires' => $p->horaires,
            'annee_creation' => $p->annee_creation,
            'slogan' => $p->slogan,
        ];
    }

    private function imagesPar(string $cat): array
    {
        return ImageVitrine::actives()
            ->categorie($cat)
            ->orderBy('ordre')
            ->get()
            ->map(fn($i) => [
                'id' => $i->id,
                'titre' => $i->titre,
                'description' => $i->description,
                'image' => $i->image_url,
                'categorie' => $i->categorie,
                'ordre' => $i->ordre,
            ])
            ->toArray();
    }

    public function accueil()
    {
        $infos = $this->getInfos();
        $heroImages = $this->imagesPar('hero');
        $entrepriseImages = $this->imagesPar('entreprise');
        $produitImages = $this->imagesPar('produit');
        $serviceImages = $this->imagesPar('service');

        return view('pages.accueil', compact('infos', 'heroImages', 'entrepriseImages', 'produitImages', 'serviceImages'));
    }

    public function apropos()
    {
        $infos = $this->getInfos();
        $entrepriseImages = $this->imagesPar('entreprise');
        $equipeImages = $this->imagesPar('equipe');

        return view('pages.apropos', compact('infos', 'entrepriseImages', 'equipeImages'));
    }

    

    public function realisations()
    {
        $infos = $this->getInfos();
        $serviceImages = $this->imagesPar('service');

        return view('pages.realisations', compact('infos', 'serviceImages'));
    }

    public function contact()
    {
        $infos = $this->getInfos();
        return view('pages.contact', compact('infos'));
    }
    public function produits()
{
    $infos = $this->getInfos();
    $categories = Categorie::actives()
        ->with(['produits' => fn($q) => $q->actifs()->orderBy('ordre')])
        ->orderBy('ordre')
        ->get();

    return view('pages.produits', compact('infos', 'categories'));
}
public function equipe()
{
    $infos = $this->getInfos();
    $membres = Equipe::actifs()->orderBy('ordre')->get();
    return view('pages.equipe', compact('infos', 'membres'));
}
}