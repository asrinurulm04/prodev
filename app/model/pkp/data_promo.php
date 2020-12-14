<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class data_promo extends Model
{
    protected $table = 'isi_promo';
    protected $primaryKey ='id_promo';
    
    public function datapromoo(){
        return $this->hasOne('App\pkp\promo','id_pkp_promo','id_pkp_promoo');
    }

    public function departement(){
        return $this->hasOne('App\users\Departement','id','tujuankirim');
    }

    public function dept(){
        return $this->hasOne('App\users\Departement','id','tujuankirim');
    }

    public function picpromo(){
        return $this->hasOne('App\pkp\picture','promo','id_pkp_promoo');
    }

    public function perevisi2(){
        return $this->hasOne('App\User','id','perevisi');
    }
}
