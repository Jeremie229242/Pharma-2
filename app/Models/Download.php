<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Download extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $table = 'downloads';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',

    ];
    protected $fillable = [
        'programe_id',

     'ville_id',
      'user_id',
'total_downloads',
       'downloaded_at'
    ];
    protected $casts = [
        'downloaded_at' => 'datetime',
    ];
    public function user()
{
    return $this->belongsTo(User::class);
}

}
