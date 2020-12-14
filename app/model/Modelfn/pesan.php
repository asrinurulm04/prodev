<?php
namespace App\Modelfn;
use Illuminate\Database\Eloquent\Model;

class pesan extends Model
{
    protected $table ='fs_chat';
    protected $fillable =['id_feasibility','pengirim','user','subject','message'];

    public function chat()
    {
        return $this->hasOne('App\Modelfn\finance','id_feasibility','id_chat');
    }

    public function chatproduksi()
    {
        return $this->hasOne('App\Modelsdm\sdm','id_sdm','id_chat');
    }

    public function chatinputor()
    {
        return $this->hasOne('App\Modelmesin\oh','id_sdm','id_chat');
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

    public function getCreatedAtAttribute($date)
{
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
}

public function getUpdatedAtAttribute($date)
{
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
}
}