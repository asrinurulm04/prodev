<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table ='brands';
    protected $primaryKey ='id';

    public function Subbrand(){
        return $this->hasMany('App\model\master\Subbrand');
    }    

}
