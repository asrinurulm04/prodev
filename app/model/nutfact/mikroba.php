<?php

namespace App\model\nutfact;

use Illuminate\Database\Eloquent\Model;

class mikroba extends Model
{
    Protected $table = 'ms_jenis_mikroba';

    public function mikro()
    {
    	return 	$this->hasMany('App\nutfact\pangan','no_kategori','no_kategori');
    }
}
