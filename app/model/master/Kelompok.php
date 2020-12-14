<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = 'kelompoks';

    public function Bahan(){
        return $this->hasMany('App\model\dev\Bahan');
    }

    protected $fillable = [
        'nama'
    ];
}
