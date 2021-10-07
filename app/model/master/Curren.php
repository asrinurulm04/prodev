<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Curren extends Model
{
    Protected $table = 'ms_currens';
    
    public function Formula(){
        return $this->hasMany('app\formula\Formula');
    }

    protected $fillable = [
        'currency',
        'harga',
        'keterangan'
    ];

}