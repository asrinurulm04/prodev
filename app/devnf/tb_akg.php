<?php

namespace App\devnf;

use Illuminate\Database\Eloquent\Model;

class tb_akg extends Model
{

    protected $table = "tb_akgs";
    protected $primaryKey ='id_akg';

    public function get_tarkon()
    {
    	return $this->belongsTo('App\master\Tarkon','tarkon','id');
    }

    public function akg()
    {
    	return $this->hasMany('App\nutfact\tb_parameter','akg','id_akg');
    }
}