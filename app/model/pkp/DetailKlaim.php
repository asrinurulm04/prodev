<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class DetailKlaim extends Model
{
    protected $table = 'tr_detail_klaim';
    protected $primaryKey ='id';

    public function datadl(){
        return $this->hasOne('App\model\pkp\DetailKlaim','id','id_detail');
    }
    
    public function komponen_klaim(){
        return $this->hasOne('App\model\pkp\komponen','id','id_detail');
    }
}
