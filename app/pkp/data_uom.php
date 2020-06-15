<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class data_uom extends Model
{
    protected $table = 'data_uom';

    public function Duom(){
        return $this->hasOne('App\pkp\uom','id','uom');
    }
}