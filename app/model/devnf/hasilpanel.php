<?php

namespace App\model\devnf;

use Illuminate\Database\Eloquent\Model;

class HasilPanel extends Model
{
    protected $table = "tr_hasil_panel";
    protected $primaryKey ='id';
    protected $fillable =['panel','HUO','tgl_panel','hasil'];
}
