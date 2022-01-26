<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'ms_satuans';

    public function Bahan(){
        return $this->hasMany('App\model\formula\Bahan');
    }

    protected $fillable = [
        'satuan'
    ];
}
