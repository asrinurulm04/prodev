<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class Jenismakanan extends Model
{
    protected $table = 'jenismakanans';

    protected $fillable = [
        'jenis_makanan',
        'batas_max',
    ];

    public function Workbook(){
        return $this->hasMany('App/dev/Workbook');
    }
}
