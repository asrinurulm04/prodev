<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class data_forecast extends Model
{
    protected $table = 'data_forecash';
    protected $primaryKey ='id';

    public function kemas(){
        return $this->belongsTo('App\kemas\datakemas','kemas_eksis','id_kemas');
    }
}
