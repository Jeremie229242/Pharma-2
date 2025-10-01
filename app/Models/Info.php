<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;



    protected $fillable = [
        'name_Info',
            'content_Info',
            'tel_Info',
            'adresse1_Info',
            'adresse12_Info',
            'ville_id',
            'image_one',
            'image_two',


    ];



    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }


}
