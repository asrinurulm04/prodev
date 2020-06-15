<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesans';

    public function Formula(){
        return $this->belongsTo('App\dev\Formula');
    }

    protected $fillable = [
        'workbook_id',
        'formula_id',
        'pengirim' ,
        'penerima' ,
        'jenis' ,
        'jenis2' ,
        'pesan' ,
        'untuk'
    ];
}
