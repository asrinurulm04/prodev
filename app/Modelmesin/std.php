<?php

namespace App\Modelmesin;

use Illuminate\Database\Eloquent\Model;

class std extends Model
{
    protected $table ='fs_std_yield_produksi';
    protected $primaryKey ='id_SYP';
    
    public function kemas()
    {
        return $this->hasOne('App\Modelkemas\userkemas','id_fk','id_SYP');
    }

    protected $fillable =[
        'id_feasibility',
        'nama_item',
        'kode_item',
        'yield_baru',
        'keterangan',
    ];

    
}
