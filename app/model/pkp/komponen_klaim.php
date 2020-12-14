<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class komponen_klaim extends Model
{
    protected $table = 'komponen_klaim';
    protected $primaryKey ='id';

    public function dataklaim(){
        return $this->hasOne('App\pkp\klaim','id','id');
    }
}
