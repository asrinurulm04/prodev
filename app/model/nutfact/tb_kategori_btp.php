<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_kategori_btp extends Model
{
    public function get_kategori()
    {
    	return 	$this->belongsTo('App\nutfact\tb_btpco','kategori','id_kategori_btp');
    }
}
