<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_parameter_cemaran extends Model
{
    public function transaksi()
    {
    	return 	$this->belongsToMany('App\nutfact\tb_transaksi_cemaran','id_parameter_cemaran','id_pc');
    }
}
