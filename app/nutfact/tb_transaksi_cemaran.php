<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_transaksi_cemaran extends Model
{
    public function jenis()
    {
    	return $this->belongsToMany('App\nutfact\tb_jenis_cemaran','id_jenis_cemaran','id_jc');
    }

    public function para()
    {
    	return $this->belongsToMany('App\nutfact\tb_parameter_cemaran', 'id_parameter_cemaran','id_pc');
    }

    public function makanan()
    {
    	return $this->belongsToMany('App\nutfact\tb_jenis_makanan','id_jenis_makanan','id_jm');
    }
}
