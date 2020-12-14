<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuans';

    public function Bahan(){
        return $this->hasMany('App\dev\Bahan');
    }

    protected $fillable = [
        'satuan'
    ];
}
