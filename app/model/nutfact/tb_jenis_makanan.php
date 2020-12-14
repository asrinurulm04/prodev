<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_jenis_makanan extends Model
{
    public function getjenis()
    {
    	return $this->belongsToMany('App\nutfact\tb_transaksi_cemaran','id_jenis_makanan','id_jm');
    }
}
