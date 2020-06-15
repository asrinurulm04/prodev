<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    protected $table = 'data_kategori';
    protected $primaryKey ='id';
    
    protected $fillable = [
        'nama_kategori',
        'id_jenis',
        'status'
    ];
    
    public function jenis(){
        return $this->belongsTo('App\pkp\jenis','id_jenis','id_jenis');
    }

    public function subkategori(){
        return $this->hasMany('App\pkp\sub','id_kategori','id');
    }

}
