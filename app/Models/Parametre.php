<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    protected $table = 'parametres';
    protected $guarded = [];

    // Singleton — toujours retourner le premier enregistrement
    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}