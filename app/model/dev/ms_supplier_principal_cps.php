<?php

namespace App\dev;

use Illuminate\Database\Eloquent\Model;

class ms_supplier_principal_cps extends Model
{
    protected $table = 'ms_supplier_principal_cps';
  
    public function sp(){
        return $this->hasOne('App\dev\ms_supplier_principals','id','ms_supplier_principal_id');
    }
}
