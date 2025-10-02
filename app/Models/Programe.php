<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Programe extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $table = 'programes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',

    ];
    protected $fillable = [
        'code',
    'name',
     'ville_id',
      'user_id',
      'file_path',
       'is_publish'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($subs) {
            $subs->code = self::generateCode();
        });


    }

    public static function generateCode()
    {
        // Récupérer le dernier code généré
        $lastCode = DB::table('programes')->orderBy('id', 'desc')->value('code');

        if ($lastCode) {
            // Extraire le numéro de la fin du dernier code
            $number = (int)substr($lastCode, -7);
            $newNumber = str_pad($number + 1, 7, '0', STR_PAD_LEFT);
        } else {
            // Si aucun code n'existe encore
            $newNumber = str_pad(1, 7, '0', STR_PAD_LEFT);
        }

        return 'PRO-PHARMA-' . $newNumber;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function ville()
    {
        return $this->belongsTo(Ville::class);
    }
}

