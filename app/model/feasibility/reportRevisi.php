<?php

namespace App\model\feasibility;

use Illuminate\Database\Eloquent\Model;

class reportRevisi extends Model
{
    protected $table = "tr_report_revisifs";

    public function user(){
        return $this->hasOne('App\model\users\User','id','perevisi');
    }
}
