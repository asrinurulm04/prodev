<?php

namespace App\model\formula;

use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    protected $table = 'tr_formulas';

    public function Workbook(){
        return $this->belongsTo('App\model\pkp\PkpProject','workbook_id','id_pkp');
    }
    
    public function Workbook_pdf(){
        return $this->belongsTo('App\model\pdf\SubPDF','workbook_pdf_id','pdf_id');
    }

    public function Fortail(){
        return $this->hasMany('App\model\formula\Fortail');
    }

    public function katpang(){
        return $this->hasOne('App\model\nutfact\CemaranCeklis','id_cemaran_ceklis','pangan');
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