<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class apppromo extends Model
{
    protected $table = 'pkp_application_promo';
    protected $primaryKey ='id_app';
    protected $fillable = [    
        'id_pkp_promo',
        'start',
        'end'
    ];
}
