<?php

namespace App\nutfact;

use Illuminate\Database\Eloquent\Model;

class pangan extends Model
{
    Protected $table = 'fs_kategori_pangan';
    
    public function mikroba()
    {
    	return $this->belongsTo('App\nutfact\mikroba','no_kategori','no_kategori');
    }

    public function panganolahan(){
        return $this->hasOne('App\nutfact\olahan','id','id_pangan');
    }
}
