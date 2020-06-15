<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class tb_kategori extends Model
{
    public function kategori()
    {
    	return 	$this->belongsTo('App\nutfact\tb_parameter','kategori','id_kategori');
    }
}
