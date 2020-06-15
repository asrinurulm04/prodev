<?php

namespace App\modelmesin;

use Illuminate\Database\Eloquent\Model;

class datayield extends Model
{
    protected $table ='fs_data_yield';
    protected $primaryKey='id_yield';
 
    protected $fillable =[
    'kode_item','nama_item','yield'
    ];

    public function kemas()
    {
        return $this->hasOne('App\Modelmesin\datayield','id_fk','id_yield');
    }
}
