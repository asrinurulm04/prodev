<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class product_allocation extends Model
{
    protected $table = 'pkp_product_allocation';
    protected $primaryKey ='id_product_allocation';

    public function sku(){
        return $this->hasOne('App\model\pkp\data_sku','id','product_sku');
    }
}
