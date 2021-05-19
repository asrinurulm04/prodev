<?php

namespace App\model\dev;

use Illuminate\Database\Eloquent\Model;

class BtpBB extends Model
{
    protected $table = 'tr_btp_bahan';

    public function satuan()
    {
    	return $this->hasOne('App\model\master\SatuanVit','id_satuan_vit','id_satuan');
    }
}
