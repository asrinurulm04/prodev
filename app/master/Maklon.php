<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Maklon extends Model
{
    protected $table = 'maklons';

    public function Formula(){
        return $this->hasMany('App\dev\Formula');
    }

    protected $fillable = [
        'maklon',
        'keterangan'
    ];
}
