<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Subkategori extends Model
{
    protected $table = 'ms_subkategoris';

    public function Bahan(){
        return $this->hasMany('App\model\formula\Bahan');
    }

    public function Kategori(){
        return $this->belongsTo('App\model\master\Kategori');
    }

    protected $fillable = [
        'subkategori',
        'kategori_id',
        'pembulatan',
    ];

}
