<?php

namespace App\model\devnf;

use Illuminate\Database\Eloquent\Model;

class panel extends Model
{
    protected $table = "ms_panel";
    protected $primaryKey ='id';
    protected $fillable =['panel'];
}
