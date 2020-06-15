<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class jenis extends Model
{
    protected $table = 'data_jenis';
    protected $primaryKey ='id_jenis';

    public function kategori(){
        return $this->hasMany('App\pkp\kategori','id_jenis','id_jenis');
    }

    protected $fillable = [    
        'nama',
        'status',
        'form'
    ];
}
