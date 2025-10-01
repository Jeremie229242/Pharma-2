<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programe extends Model
{
    protected $fillable = ['commune_id','pharmacie_id', 'ville_id', 'date_debut', 'date_fin', 'is_garde'];

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacie::class, 'programe_pharmacie');
    }
    public function pharmacie()
    {
        return $this->belongsTo(Pharmacie::class);
    }
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
}

