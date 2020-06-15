<?php

namespace App\Modellab;

use Illuminate\Database\Eloquent\Model;

class Dlab extends Model
{
    protected $table ='fs_lab';
    protected $primaryKey ='id_lab';
    protected $fillable =['id_feasibility','no_kategori','jenis_mikroba','kode_analisa','tahunan','harian','status','rate'];

    public function id()
    {
        return $this->hasOne('App\Modelfn\finance','id_feasibility','id_lab');
    }

    public function datalab()
    {
        return $this->belongsTo('App\Modelfn\finance','id_feasibility','id_lab');
    }
}
