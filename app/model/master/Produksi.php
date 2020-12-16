<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = 'produksis';

    public function Formula(){
        return $this->hasMany('App\model\dev\Formula');
    }

    protected $fillable = [
        'produksi',
        'keterangan'
    ];
}
