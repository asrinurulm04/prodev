<?php

namespace App\model\dev;

use Illuminate\Database\Eloquent\Model;

class tr_btp_bb extends Model
{
    protected $table = 'tr_btp_bahan';

    public function satuan()
    {
    	return $this->hasOne('App\model\master\tb_satuan_vit','id_satuan_vit','id_satuan');
    }
}
