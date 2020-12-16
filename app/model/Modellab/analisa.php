<?php

namespace App\model\Modellab;

use Illuminate\Database\Eloquent\Model;

class analisa extends Model
{
    protected $table ='fs_kode_analisa';
    protected $primaryKey ='id_kode';
    protected $fillable =['kode_analisa','rate'];
}
