<?php

namespace App\model\dev;

use Illuminate\Database\Eloquent\Model;

class tr_mikro_bb extends Model
{
    protected $table = 'tr_mikro_biologi_bb';
    protected $primaryKey ='id_mikro_bilogi ';

    public function jenis()
    {
    	return $this->hasOne('App\model\nutfact\tb_jenis_mikroba','id','id_jenis_mikro');
    }

    public function bpom()
    {
    	return $this->hasOne('App\model\pkp\pkp_datapangan','id_pangan','id_bpom');
    }
}
