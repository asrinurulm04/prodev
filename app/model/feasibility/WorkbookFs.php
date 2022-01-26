<?php

namespace App\model\feasibility;

use Illuminate\Database\Eloquent\Model;

class WorkbookFs extends Model
{
    protected $table = "tr_workbook_fs";
    
    public function fs(){
        return $this->hasOne('App\model\feasibility\Feasibility','id','id_feasibility');
    }
}
