<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ville',

    ];

    public function users()
{
    return $this->hasMany(User::class);
}


public function communes()
{
    return $this->hasMany(Commune::class);
}

public function pharmacies()
{
    return $this->hasManyThrough(Pharmacie::class, Commune::class);
}

public function infos()
{
    return $this->hasMany(Info::class);
}

}
