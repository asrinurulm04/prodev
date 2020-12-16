<?php

namespace App\model\devnf;

use Illuminate\Database\Eloquent\Model;

class tb_nutrition extends Model
{
    public function get_bahan()
    {
    	return $this->belongsTo('App\model\dev\Bahan','bahan','id');
    }
    
    public function get_btp()
    {
    	return $this->belongsTo('App\model\nutfact\tb_btpco','btp','id_btp');
    }
}