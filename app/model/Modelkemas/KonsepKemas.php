<?php

namespace App\model\Modelkemas;

use Illuminate\Database\Eloquent\Model;

class KonsepKemas extends Model
{
    protected $table ='tr_datakemas';
    protected $primaryKey ='id';

    public function sku(){
        return $this->hasOne('App\model\pkp\SKU','id','referensi');
    }

    public function wb(){
        return $this->hasOne('App\model\feasibility\WorkbookFs','id','id_ws');
    }
}
