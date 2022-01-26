<?php

namespace App\model\nutfact;

use Illuminate\Database\Eloquent\Model;

class MikroBiologiBB extends Model
{
    protected $table = 'tr_mikro_biologi_bb';
    protected $primaryKey ='id_mikro_bilogi ';

    public function jenis()
    {
    	return $this->hasOne('App\model\nutfact\JenisMikroba','id','id_jenis_mikro');
    }

    public function bpom()
    {
    	return $this->hasOne('App\model\pkp\DataPangan','id_pangan','id_bpom');
    }
}
