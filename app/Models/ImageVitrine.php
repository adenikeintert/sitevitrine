<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageVitrine extends Model
{
    protected $table = 'images_vitrine';
    protected $guarded = [];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset('storage/' . $this->image);
    }

    // Scope : actives
    public function scopeActives($query)
    {
        return $query->where('actif', true);
    }

    // Scope : par catégorie
    public function scopeCategorie($query, string $cat)
    {
        return $query->where('categorie', $cat);
    }

    // Liste des catégories
    public static function categories(): array
    {
        return [
            'hero' => 'Hero / Slider',
            'produit' => 'Produits',
            'entreprise' => 'Entreprise',
            'equipe' => 'Équipe',
            'service' => 'Réalisations',
        ];
    }

    // Supprimer le fichier physique à la suppression
    protected static function booted()
    {
        static::deleting(function ($img) {
            if ($img->image && !str_starts_with($img->image, 'http')) {
                Storage::disk('public')->delete($img->image);
            }
        });
    }
}