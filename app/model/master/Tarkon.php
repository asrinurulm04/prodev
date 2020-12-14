<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Tarkon extends Model
{
    protected $table = 'tarkons';

    public function Workbook(){
        return $this->hasMany('App\dev\Workbook');
    }

    protected $fillable = [
        'tarkons'
    ];
}
