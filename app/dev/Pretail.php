<?php

namespace App\dev;

use Illuminate\Database\Eloquent\Model;

class Pretail extends Model
{
    protected $table = 'pretails';

    public function Premix(){
        return $this->belongsTo('App\dev\Premix');
    }

    protected $fillable = [
        'premix_id',
        'premix_ke',
        'awalan',
        'turunan',
        'jumlah',
        'kode_kantong',
    ];
}
