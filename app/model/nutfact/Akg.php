<?php

namespace App\model\nutfact;

use Illuminate\Database\Eloquent\Model;

class Akg extends Model
{

    protected $table = "ms_akg";
    protected $primaryKey ='id_akg';

    public function get_tarkon()
    {
    	return $this->belongsTo('App\model\master\Tarkon','tarkon','id');
    }

    public function akg()
    {
    	return $this->hasMany('App\model\pkp\ParameterForm','akg','id_akg');
    }
}