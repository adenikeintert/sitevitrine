<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Categorie extends Model
{
    protected $guarded = [];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer',
    ];

    protected $appends = ['image_url'];

    public function produits()
    {
        return $this->hasMany(Produit::class)->orderBy('ordre');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset('storage/' . $this->image);
    }

    public function scopeActives($query)
    {
        return $query->where('actif', true);
    }

    protected static function booted()
    {
        static::creating(function ($cat) {
            if (empty($cat->slug)) {
                $cat->slug = \Illuminate\Support\Str::slug($cat->nom);
            }
        });

        static::deleting(function ($cat) {
            if ($cat->image && !str_starts_with($cat->image, 'http')) {
                Storage::disk('public')->delete($cat->image);
            }
        });
    }
}