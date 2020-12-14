<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Subkategori extends Model
{
    protected $table = 'subkategoris';

    public function Bahan(){
        return $this->hasMany('App\dev\Bahan');
    }

    public function Kategori(){
        return $this->belongsTo('App\master\Kategori');
    }

    protected $fillable = [
        'subkategori',
        'kategori_id',
        'pembulatan',
    ];

}
