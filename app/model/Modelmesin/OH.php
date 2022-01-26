<?php

namespace App\model\Modelmesin;

use Illuminate\Database\Eloquent\Model;

class OH extends Model
{
    protected $table ='tr_dataoh';

    public function oh()
    {
        return $this->hasOne('App\model\Modelmesin\DataOH','id','id_oh');
    }
}
