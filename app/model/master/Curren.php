<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Curren extends Model
{
    Protected $table = 'currens';
    
    public function Formula(){
        return $this->hasMany('app\dev\Formula');
    }

    protected $fillable = [
        'currency',
        'harga',
        'keterangan'
    ];

}