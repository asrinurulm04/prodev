<?php

namespace App\model\dev;

use Illuminate\Database\Eloquent\Model;

class Fortail extends Model
{
    protected $table = 'tr_fortails';

    public function Formula(){
        return $this->belongsTo('App\model\dev\Formula');
    }

    public function Premix(){
        return $this->hasMany('App\model\dev\Premix');
    }

    public function Bahan(){
        return $this->belongsTo('App\model\dev\Bahan');
    }

    // Alternatif relationship

    public function k2(){
        return $this->belongsTo('App\model\dev\Fortail','kode_komputer2','id');
    }

    public function k3(){
        return $this->belongsTo('App\model\dev\Fortail','kode_komputer3','id');
    }

    public function k4(){
        return $this->belongsTo('App\model\dev\Fortail','kode_komputer4','id');
    }

    public function k5(){
        return $this->belongsTo('App\model\dev\Fortail','kode_komputer5','id');
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
