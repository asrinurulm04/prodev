<?php

namespace App\pkp;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    protected $table = 'menu_dinamis';
    protected $primaryKey ='id_menu';

    public function datamenu(){
        return $this->hasOne('App\role','id','akses');
    }
}
