<?php

namespace App\model\Modelmesin;


use Illuminate\Database\Eloquent\Model;

class DataMesin extends Model
{
    
    protected $table ='ms_mesin';
    protected $primaryKey='id_mesin';
 
    protected $fillable =[
    'id_feasibility','id_data_mesin','runtime','SDM','rate_mesin','hasil','standar_sdm','line'
    ];

    public function meesin()
    {
        return $this->belongsTo('App\model\Modelmesin\Mesin','id_data_mesin','id_data_mesin');
    }

    public static function getExcerpt($str, $startPos = 0, $maxLength = 50) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength - 6);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= ' [...]';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }
}
