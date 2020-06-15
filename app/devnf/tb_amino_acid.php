<?php

namespace App\devnf;

use Illuminate\Database\Eloquent\Model;

class tb_amino_acid extends Model
{
    public function get_ingre()
    {
    	return 	$this->belongsTo('App\nutfact\tb_ingredient','ingredient','id_ingredient');
    }

    public function get_para()
    {
    	return 	$this->belongsTo('App\nutfact\tb_parameter','parameter','id_p');
    }
}
