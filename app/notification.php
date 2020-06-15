<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $table = 'notification';

    protected $fillable = ['title','id_pkp','id_pdf','id_promo','turunan','perevisi'];

    public function users(){
        return $this->hasOne('App\user','id','perevisi');
    }

    public function project(){
        return $this->hasOne('App\pkp\pkp_project','id_project','id_pkp');
    }

    public function pdf(){
        return $this->hasOne('App\pkp\project_pdf','id_project_pdf','id_pdf');
    }

    public function promo(){
        return $this->hasOne('App\pkp\promo','id_pkp_promo','id_promo');
    }
}
