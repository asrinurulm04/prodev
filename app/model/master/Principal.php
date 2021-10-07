<?php

namespace App\model\master;

use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    protected $table = 'ms_supplier_principal_cps';
  
    public function sp(){
        return $this->hasOne('App\model\master\Supplier','id','ms_supplier_principal_id');
    }
}
