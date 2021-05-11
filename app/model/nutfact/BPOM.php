<?php

namespace App\model\nutfact;

use Illuminate\Database\Eloquent\Model;

class BPOM extends Model
{
    Protected $table = 'ms_bpom_mikrobiologi';
    
    public function mikroba()
    {
    	return $this->belongsTo('App\nutfact\Mikroba','no_kategori','no_kategori');
    }

}
