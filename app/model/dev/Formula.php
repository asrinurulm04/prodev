<?php

namespace App\model\dev;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $table = 'formulas';

    public function Workbook(){
        return $this->belongsTo('App\model\pkp\tipp','workbook_id','id_pkp');
    }
    
    public function Workbook_pdf(){
        return $this->belongsTo('App\model\pkp\coba','workbook_pdf_id','pdf_id');
    }

    public function Fortail(){
        return $this->hasMany('App\model\dev\Fortail');
    }

    public function Brand(){
        return $this->belongsTo('App\model\master\Brand');
    }

    public function Produksi(){
        return $this->belongsTo('App\model\master\Produksi');
    }

    public function Maklon(){
        return $this->belongsTo('App\model\master\Maklon');
    }

    public function Gudang(){
        return $this->belongsTo('App\model\master\Gudang');
    }

    public function finance(){
        return $this->hasMany('App\model\Modelfn\finance','id_feasibility','id');
    }

    public function Pesan(){
        return $this->hasMany('App\model\Pesan');
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
