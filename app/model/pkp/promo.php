<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'tr_project_promo';
    protected $primaryKey ='id_pkp_promo';

    public function departement(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim');
    }
    
    public function departement2(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim2');
    }

    public function users(){
        return $this->hasOne('App\model\users\User','id','userpenerima');
    }

    public function author1(){
        return $this->hasOne('App\model\users\User','id','Author');
    }

    public function not(){
        return $this->hasOne('App\model\pkp\Notulen','id_promo','id_pkp_promo');
    }

    public function users2(){
        return $this->hasOne('App\model\users\user','id','userpenerima2');
    }

    public function datapromo(){
        return $this->hasOne('App\model\pkp\DataPromo','id_pkp_promoo','id_pkp_promo');
    }
}
