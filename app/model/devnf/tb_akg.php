<?php

namespace App\model\devnf;

use Illuminate\Database\Eloquent\Model;

class tb_akg extends Model
{

    protected $table = "ms_akg";
    protected $primaryKey ='id_akg';

    public function get_tarkon()
    {
    	return $this->belongsTo('App\model\master\Tarkon','tarkon','id');
    }

    public function akg()
    {
    	return $this->hasMany('App\model\nutfact\tb_parameter','akg','id_akg');
    }
}