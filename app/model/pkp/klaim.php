<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class Klaim extends Model
{
    protected $table = 'ms_klaim';
    protected $primaryKey ='id';

    public function komponen(){
        return $this->hasOne('App\model\pkp\Komponen','id','id_komponen');
    }
}
