<?php

namespace App\model\formula;

use Illuminate\Database\Eloquent\Model;

class Fortail extends Model
{
    protected $table = 'tr_fortails';

    public function Formula(){
        return $this->belongsTo('App\model\formula\Formula');
    }

    public function Premix(){
        return $this->hasMany('App\model\formula\Premix');
    }

    public function Bahan(){
        return $this->belongsTo('App\model\formula\Bahan');
    }

    public function bb(){
        return $this->belongsTo('App\model\formula\Bahan','bahan_id','id');
    }

    // Alternatif relationship
    public function k2(){
        return $this->belongsTo('App\model\formula\Fortail','kode_komputer2','id');
    }

    public function k3(){
        return $this->belongsTo('App\model\formula\Fortail','kode_komputer3','id');
    }

    public function k4(){
        return $this->belongsTo('App\model\formula\Fortail','kode_komputer4','id');
    }

    public function k5(){
        return $this->belongsTo('App\model\formula\Fortail','kode_komputer5','id');
    }

    public function allergen(){
        return $this->hasMany('App\model\nutfact\AllergenBB','bahan_id','id_bb_allergen ');
    }

    protected $fillable = [
        'formula_id',
        'kode_komputer',
        'nama_sederhana',
        'kode_oracle',
        'bahan_id',
        'nama_bahan',
        'per_batch',
        'per_serving',
        'jenis_timbangan',
        'alternatif',
        'kode_komputer2',
        'kode_komputer3',
        'kode_komputer4',
        'kode_komputer5',
        'granulasi',
    ];

}