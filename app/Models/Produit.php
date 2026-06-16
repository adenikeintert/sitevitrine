<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Produit extends Model
{
    protected $guarded = [];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer',
        'prix' => 'decimal:2',
    ];

    protected $appends = ['image_url'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;
        if (str_starts_with($this->image, 'http')) return $this->image;
        return asset('storage/' . $this->image);
    }

    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    protected static function booted()
    {
        static::creating(function ($p) {
            if (empty($p->slug)) {
                $p->slug = \Illuminate\Support\Str::slug($p->nom) . '-' . \Illuminate\Support\Str::random(5);
            }
        });

        static::deleting(function ($p) {
            if ($p->image && !str_starts_with($p->image, 'http')) {
                Storage::disk('public')->delete($p->image);
            }
        });
    }
}