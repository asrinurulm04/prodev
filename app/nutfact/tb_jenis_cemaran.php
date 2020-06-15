<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_jenis_cemaran extends Model
{
    public function cemaran()
    {
    	return $this->belongsToMany('App\nutfact\tb_transaksi_cemaran','id_jenis_cemaran','id_jc');
    }
}
