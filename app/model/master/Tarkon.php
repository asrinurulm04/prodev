<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Tarkon extends Model
{
    protected $table = 'ms_tarkons';

    public function Workbook(){
        return $this->hasMany('App\model\dev\Workbook');
    }

    protected $fillable = [
        'tarkons'
    ];
}
