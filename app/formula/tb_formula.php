<?php

namespace App\formula;

use Illuminate\Database\Eloquent\Model;

class tb_formula extends Model
{
    protected $table = 'tb_formula';
    protected $primaryKey ='id_formula';

    public function Bahans(){
        return $this->hasOne('App\dev\Bahan','id','id_bahan');
    }
}
