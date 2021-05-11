<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class DataKlaim extends Model
{
    protected $table = 'tr_klaim';
    protected $primaryKey ='id';

    public function datakp(){
        return $this->hasOne('App\model\pkp\Komponen','id','id_komponen');
    }

    public function datakl(){
        return $this->hasOne('App\model\pkp\Klaim','id','id_klaim');
    }

    public function datadt(){
        return $this->hasOne('App\model\pkp\DetailKlaim','id_klaim','id');
    }
}
