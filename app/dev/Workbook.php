<?php

namespace App\dev;

use Illuminate\Database\Eloquent\Model;

class Workbook extends Model
{
    protected $table = 'workbooks';
    
    protected $fillable = [
        'nama_project',        
        'mnrq',
        'user_id',
        'tarkon_id',
        'bintang',
        'keterangan',
        'NO_PKP',
        'jenis',
        'revisi',
        'jenismakanan_id',
        'subbrand_id',
        'deskripsi',
        'target_serving',
        'status'
    ];

    public function User(){
        return $this->belongsTo('App\User');
    }

    public function Tarkon(){
        return $this->belongsTo('App\master\Tarkon');
    }

    public function Formula(){
        return $this->hasMany('App\dev\Formula');
    }

    public function Subbrand(){
        return $this->belongsTo('App\master\Subbrand');
    }

    public function Jenismakanan(){
        return $this->belongsTo('App\master\Jenismakanan');
    }
}
