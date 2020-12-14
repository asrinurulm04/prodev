<?php

namespace App\devnf;

use Illuminate\Database\Eloquent\Model;

class tb_nutrition extends Model
{
    public function get_bahan()
    {
    	return $this->belongsTo('App\dev\Bahan','bahan','id');
    }
    
    public function get_btp()
    {
    	return $this->belongsTo('App\nutfact\tb_btpco','btp','id_btp');
    }
}