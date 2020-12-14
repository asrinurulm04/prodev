<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class mikroba extends Model
{
    Protected $table = 'fs_jenismikroba';

    public function mikro()
    {
    	return 	$this->hasMany('App\nutfact\pangan','no_kategori','no_kategori');
    }
}
