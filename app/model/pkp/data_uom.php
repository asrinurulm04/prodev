<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class data_uom extends Model
{
    protected $table = 'data_uom';

    public function Duom(){
        return $this->hasOne('App\model\pkp\uom','id','uom');
    }
}