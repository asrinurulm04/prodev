<?php

namespace App\model\Modellab;

use Illuminate\Database\Eloquent\Model;

class DataLab extends Model
{
    protected $table ='tr_lab';
    protected $primaryKey ='id_lab';
    protected $fillable =['id_feasibility','no_kategori','jenis_mikroba','kode_analisa','tahunan','harian','status','rate'];

}
