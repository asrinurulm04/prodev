<?php

namespace App\model\formula;

use Illuminate\Database\Eloquent\Model;

class hasilpanel extends Model
{
    protected $table = "tr_hasil_panel";
    protected $primaryKey ='id';
    protected $fillable =['panel','HUO','tgl_panel','hasil'];
}
