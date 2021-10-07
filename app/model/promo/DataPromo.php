<?php

namespace App\model\promo;

use Illuminate\Database\Eloquent\Model;

class DataPromo extends Model
{
    protected $table = 'tr_promo';
    protected $primaryKey ='id_promo';
    
    public function datapromoo(){
        return $this->hasOne('App\model\promo\promo','id_pkp_promo','id_pkp_promoo');
    }

    public function departement(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim');
    }

    public function dept2(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim2');
    }

    public function picpromo(){
        return $this->hasOne('App\model\pkp\FileProject','promo','id_pkp_promoo');
    }

    public function perevisi2(){
        return $this->hasOne('App\model\users\User','id','perevisi');
    }
}
