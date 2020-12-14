<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';

    public function Subkategori(){
        return $this->hasMany('App\master\Subkategori');
    }

    protected $fillable = [
        'kategori',
    ];
}
