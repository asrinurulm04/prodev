<?php

namespace App\model\nutfact;

use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    public function get_bahan()
    {
    	return $this->belongsTo('App\model\formula\Bahan','bahan','id');
    }
}