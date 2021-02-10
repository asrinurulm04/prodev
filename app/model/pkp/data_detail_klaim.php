<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class data_detail_klaim extends Model
{
    protected $table = 'tr_detail_klaim';
    protected $primaryKey ='id';

    public function datadl(){
        return $this->hasOne('App\model\pkp\detail_klaim','id','id_detail');
    }
    
}
