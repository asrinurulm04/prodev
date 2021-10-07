<?php

namespace App\model\pdf;

use Illuminate\Database\Eloquent\Model;

class ProjectPDF extends Model
{
    protected $table = 'tr_pdf_project';
    protected $primaryKey ='id_project_pdf';

    public function departement(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim');
    }

    public function departement2(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim2');
    }

    public function datappdf(){
        return $this->hasOne('App\model\pdf\SubPDF','pdf_id','id_project_pdf');
    }
    public function nott(){
        return $this->hasOne('App\model\pkp\notulen','id_pdf','id_project_pdf');
    }

    public function users(){
        return $this->hasOne('App\model\users\User','id','userpenerima');
    }

    public function author1(){
        return $this->hasOne('App\model\users\User','id','author');
    }

    public function perevisi1(){
        return $this->hasOne('App\model\users\User','id','perevisi');
    }

    public function users2(){
        return $this->hasOne('App\model\users\User','id','userpenerima2');
    }

    public function type(){
        return $this->belongsTo('App\model\pkp\Type','id_type','id');
    }

    public function for1(){
        return $this->hasOne('App\model\pkp\Forecast','id_pdf','id_project_pdf');
    }
}