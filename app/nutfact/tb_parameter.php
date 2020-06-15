<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_parameter extends Model
{
    public function get_kategori()
    {
    	return $this->belongsTo('App\nutfact\tb_kategori','kategori','id_kategori');
    }

    public function get_akg()
    {
    	return $this->belongsTo('App\devnf\tb_akg','akg','id_akg');
    }

    public function nutrition()
    {
    	return $this->hasMany('App\devnf\tb_nutrition','parameter','id_p');
    }

    public function acid()
    {
        return $this->hasMany('App\devnf\tb_amino_acid','parameter','id_p');
    }    

    public function p()
    {
        return $this->hasMany('App\devnf\tb_vitmin','parameter','id_p');
    }

    public function hitung()
    {
        return $this->hasMany('App\devnf\tb_analisa','parameter','id_p');
    }
}
