<?php

namespace App\dev;

use Illuminate\Database\Eloquent\Model;

class Premix extends Model
{
    protected $table = 'premixs';

    public function Fortail(){
        return $this->belongsTo('App\dev\Fortail');
    }

    public function Pretail(){
        return $this->hasMany('App\dev\Pretail');
    }

    protected $fillable = [
        'fortail_id',
        'utuh',
        'koma',
        'utuh_cpb',
        'koma_cpb',
        'satuan',
        'berat',
        'keterangan',
    ];
}
