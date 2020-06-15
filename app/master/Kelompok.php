<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompoks';

    public function Bahan(){
        return $this->hasMany('App\dev\Bahan');
    }

    protected $fillable = [
        'nama'
    ];
}
