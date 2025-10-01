<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_commune',
        'ville_id',
    ];


    public function ville()
{
    return $this->belongsTo(Ville::class);
}

public function pharmacies()
{
    return $this->hasMany(Pharmacie::class);
}

}
