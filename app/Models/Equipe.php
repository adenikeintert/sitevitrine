<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Equipe extends Model
{
    protected $guarded = [];

    protected $casts = [
        'actif' => 'boolean',
        'ordre' => 'integer',
    ];

    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo) return null;
        if (str_starts_with($this->photo, 'http')) return $this->photo;
        return asset('storage/' . $this->photo);
    }

    public function scopeActifs($query)
    {
        return $query->where('actif', true);
    }

    protected static function booted()
    {
        static::deleting(function ($m) {
            if ($m->photo && !str_starts_with($m->photo, 'http')) {
                Storage::disk('public')->delete($m->photo);
            }
        });
    }
}