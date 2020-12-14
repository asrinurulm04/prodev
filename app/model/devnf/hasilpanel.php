<?php

namespace App\devnf;

use Illuminate\Database\Eloquent\Model;

class hasilpanel extends Model
{
    protected $table = "hasil_panel";
    protected $primaryKey ='id';
    protected $fillable =['panel','HUO','tgl_panel','hasil'];
}
