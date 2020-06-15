<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class arsen extends Model
{
    protected $table = 'logam_berat_arsen';
    protected $primaryKey ='id_arsen';
    protected $fillable = [    
        'id_arsen',
        'jenis_makanan',
        'batasan_maksimum'
    ];
}