<?php

namespace App\model\dev;

use Illuminate\Database\Eloquent\Model;

class tr_zataktif_bb extends Model
{
    protected $table = 'tr_zataktif_bb';

    public function satuan()
    {
    	return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan');
    }
}
