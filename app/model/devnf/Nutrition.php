<?php

namespace App\model\devnf;

use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    public function get_bahan()
    {
    	return $this->belongsTo('App\model\dev\Bahan','bahan','id');
    }