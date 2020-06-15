<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class tipp extends Model
{
    protected $table = 'tippu';
    protected $primaryKey ='id';

    public function datapkpp(){
        return $this->hasOne('App\pkp\pkp_project','id_project','id_pkp');
    }

    public function for1(){
        return $this->hasOne('App\pkp\data_forecast','id_pkp','id_pkp');
    }

    public function departement(){
        return $this->hasOne('App\users\Departement','id','tujuankirim');
    }

    public function datapangan(){
        return $this->hasOne('App\nutfact\datapangan','id_datapangan','bpom');
    }

    public function kategori(){
        return $this->hasOne('App\nutfact\pangan','id_pangan','kategori_bpom');
    }

    public function panganolahan(){
        return $this->hasOne('App\nutfact\olahan','id','olahan');
    }

    public function katpangan(){
        return $this->hasOne('App\nutfact\pangan','id_pangan','kategori_bpom');
    }

    public function Dklaim(){
        return $this->hasOne('App\pkp\data_klaim','id_pkp','id_pkp');
    }

    public function tarkon(){
        return $this->hasOne('App\master\Tarkon','id_tarkon','akg');
    }

    public function kemas(){
        return $this->belongsTo('App\kemas\datakemas','kemas_eksis','id_kemas');
    }
    
    public function Duom(){
        return $this->hasOne('App\pkp\uom','id','UOM');
    }

    public function picpkp(){
        return $this->hasOne('App\pkp\picture','pkp_id','id_pkp');
    }

    public function perevisi2(){
        return $this->hasOne('App\User','id','perevisi');
    }
}
