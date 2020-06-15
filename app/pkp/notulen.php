<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class notulen extends Model
{
    protected $table = 'tb_notulen';

    public function pkp(){
        return $this->hasOne('App\pkp\pkp_project','id_project','id_pkp');
    }

    public function pdf(){
        return $this->hasOne('App\pkp\project_pdf','id_project_pdf','id_pdf');
    }

    public function promo(){
        return $this->hasOne('App\pkp\promo','id_pkp_promo','id_promo');
    }

    public function users(){
        return $this->hasOne('App\User','id','user');
    }

}
