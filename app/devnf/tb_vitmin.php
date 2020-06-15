<?php

namespace App\devnf;

use Illuminate\Database\Eloquent\Model;

class tb_vitmin extends Model
{
    public function get_p()
    {
        return $this->belongsTo('App\nutfact\tb_parameter','parameter','id_p');
    }
}
