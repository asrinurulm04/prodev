<?php

namespace App\master;

use Illuminate\Database\Eloquent\Model;

class bahan_rd extends Model
{
    protected $table ='tb_bahanbaku_rd';
    protected $primaryKey ='id_bahan';

    // Kebutuhan Formula

    public function Fortail(){
        return $this->hasMany('App\dev\Fortail');
    }

    public function k2(){
        return $this->hasMany('App\dev\Fortail','kode_komputer2','id');
    }

    public function k3(){
        return $this->hasMany('App\dev\Fortail','kode_komputer3','id');
    }

    public function k4(){
        return $this->hasMany('App\dev\Fortail','kode_komputer4','id');
    }

    public function k5(){
        return $this->hasMany('App\dev\Fortail','kode_komputer5','id');
    }

    // Other

    public function Satuan(){
        return $this->belongsTo('App\master\Satuan');
    }

    public function Subkategori(){
        return $this->belongsTo('App\master\Subkategori');
    }

    public function Curren(){
        return $this->belongsTo('App\master\Curren');
    }

    public function Kelompok(){
        return $this->belongsTo('App\master\Kelompok');
    }

    public function User(){
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
    'nama_sederhana',
    'nama_bahan',
    'kode_oracle',
    'kode_komputer',
    'supplier',
    'principle',
    'no_HEIPBR',
    'PIC',
    'cek_halal',
    'berat',
    'satuan_id',
    'subkategori_id',
    'harga_satuan',
    'curren_id',
    'user_id',
    'kelompok_id',
    'status',
    ];
}
