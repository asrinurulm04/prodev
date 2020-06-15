<?php

namespace App\devnf;

use Illuminate\Database\Eloquent\Model;

class tb_analisa extends Model
{
	public function get_parame()
    {
    	return 	$this->belongsTo('App\nutfact\tb_parameter','parameter','id_p');
    }

    public function get_f1()
    {
    	return 	$this->belongsTo('App\dev\Formula','formula','id');
    }
}