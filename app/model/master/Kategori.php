<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategoris';

    public function Subkategori(){
        return $this->hasMany('App\model\master\Subkategori');
    }

    protected $fillable = [
        'kategori',
    ];
}
