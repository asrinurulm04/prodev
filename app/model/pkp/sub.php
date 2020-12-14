<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class sub extends Model
{
    protected $table = 'data_subkategori';
    protected $primaryKey ='id_subkategori';

    public function kategori(){
        return $this->belongsTo('App\pkp\kategori','id_kategori','id');
    }

    protected $fillable = [    
        'nama_sub',
        'status',
        'id_kategori'
    ];
    
}
