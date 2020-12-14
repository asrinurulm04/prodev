<?php

namespace App\model\pkp;

use Illuminate\Database\Eloquent\Model;

class pkp_project extends Model
{
    protected $table = 'pkp_project';
    protected $primaryKey ='id_project';

    public function departement(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim');
    }

    public function departement2(){
        return $this->hasOne('App\model\users\Departement','id','tujuankirim2');
    }

    public function not(){
        return $this->hasOne('App\model\pkp\notulen','id_pkp','id_project');
    }

    public function users(){
        return $this->hasOne('App\model\User','id','userpenerima');
    }

    public function author1(){
        return $this->hasOne('App\model\User','id','author');
    }

    public function perevisi1(){
        return $this->hasOne('App\model\User','id','perevisi');
    }

    public function users2(){
        return $this->hasOne('App\model\User','id','userpenerima2');
    }

    public function datapkp(){
        return $this->hasOne('App\model\pkp\tipp','id_pkp','id_project');
    }

    public function for(){
        return $this->hasOne('App\model\pkp\data_forecast','id_pkp','id_project');
    }

    public function datases(){
        return $this->hasOne('App\model\pkp\ses','id_pkp','id_project');
    }

    public function Dklaim(){
        return $this->hasOne('App\model\pkp\data_klaim','id_pkp','id_project');
    }
    
    public function datauom(){
        return $this->hasOne('App\model\pkp\uom','id','UOM');
    }

    public function datakemas(){
        return $this->hasOne('App\model\kemas\datakemas','id_kemas','eksis');
    }

    public function datatarkon(){
        return $this->hasOne('App\model\master\Tarkon','id_tarkon','akg');
    }

    public function pic(){
        return $this->hasMany('App\model\pkp\picture','pkp_id','id_project');
    }
}
