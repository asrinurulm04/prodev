<?php

namespace App\dev;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $table = 'formulas';

    public function Workbook(){
        return $this->belongsTo('App\pkp\tipp','workbook_id','id_pkp');
    }

    public function Fortail(){
        return $this->hasMany('App\dev\Fortail');
    }

    public function Brand(){
        return $this->belongsTo('App\master\Brand');
    }

    public function Produksi(){
        return $this->belongsTo('App\master\Produksi');
    }

    public function Maklon(){
        return $this->belongsTo('App\master\Maklon');
    }

    public function Gudang(){
        return $this->belongsTo('App\master\Gudang');
    }

    public function finance(){
        return $this->hasMany('App\Modelfn\finance','id_feasibility','id');
    }

    public function Pesan(){
        return $this->hasMany('App\Pesan');
    }    


    protected $fillable = [
        'workbook_id',
        'revisi',
        'versi',
        'turunan',
        'kode_formula',
        'subbrand_id',
        'nama_produk',
        'produksi_id',
        'maklon_id',
        'gudang_id',
        'jenis',
        'main_item',
        'main_item_eks',
        'bj',
        'batch',
        'serving',
        'liter',
        'kfp_premix',
        'keterangan',
        'status',
        'vv',
        'status_fisibility',
        'status_nutfact',
    ];
}
