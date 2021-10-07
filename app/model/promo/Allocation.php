<?php

namespace App\model\promo;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $table = 'tr_product_allocation';
    protected $primaryKey ='id_product_allocation';

    public function sku(){
        return $this->hasOne('App\model\pkp\SKU','id','product_sku');
    }
}
