<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    protected $table ='gudangs';

    public function Formula(){
        return $this->hasMany('App\dev\Formula');
    }

    protected $fillable = [
        'gudang',
        'keterangan'
    ];
}
