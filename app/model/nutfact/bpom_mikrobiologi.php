<?php

namespace App\model\nutfact;

use Illuminate\Database\Eloquent\Model;

class bpom_mikrobiologi extends Model
{
    Protected $table = 'ms_bpom_mikrobiologi';
    
    public function mikroba()
    {
    	return $this->belongsTo('App\nutfact\mikroba','no_kategori','no_kategori');
    }

    public function panganolahan(){
        return $this->hasOne('App\nutfact\olahan','id','id_pangan');
    }
}
