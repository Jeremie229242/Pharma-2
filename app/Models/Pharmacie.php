<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_pharmacie',
        'adresse',
        'telephone',
        'commune_id',
    ];

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
    public function programes()
    {
        return $this->belongsToMany(Programe::class, 'programe_pharmacie');
    }
   
}
