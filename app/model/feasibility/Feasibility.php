<?php

namespace App\model\feasibility;

use Illuminate\Database\Eloquent\Model;

class Feasibility extends Model
{
    protected $table = "tr_feasibility";

    public function workbook(){
        return $this->hasOne('App\model\formula\Formula','id','id_formula');
    }

    public function datapkp(){
        return $this->belongsTo('App\model\pkp\PkpProject','id_project','id_project');
    }

    public function pdf(){
        return $this->hasOne('App\model\pdf\ProjectPDF','id_project_pdf','id_project_pdf');
    }

    public function pkp(){
        return $this->hasOne('App\model\pkp\PkpProject','id_project','id_project');
    }

    public function form(){
        return $this->hasOne('App\model\feasibility\FormPengajuanFS','id_feasibility','id');
    }

    public function workbook2(){
        return $this->hasOne('App\model\feasibility\WorkbookFs','id','id_feasibility');
    }

}
