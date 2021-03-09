<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class komponen_klaim extends Model
{
    protected $table = 'ms_komponen_klaim';
    protected $primaryKey ='id';

    public function dataklaim(){
        return $this->hasOne('App\model\pkp\klaim','id','id');
    }
}
