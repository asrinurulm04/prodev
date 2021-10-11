<?php

namespace App\model\feasibility;

use Illuminate\Database\Eloquent\Model;

class Feasibility extends Model
{
    protected $table = "tr_feasibility";

    
    public function workbook(){
        return $this->hasOne('App\model\formula\Formula','id','id_formula');
    }

    protected $fillable = [
    'id',
    'id_formula',
    'id_project',
    'revisi',
    'revisi_kemas',
    'revisi_proses',
    'revisi_produk',
    'status_proses',
    'status_maklon',
    'status_kemas',
    'status_lab',
    'status_product',
    'status_feasibility',
    ];
}
