<?php

namespace App\model\devnf;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    protected $table = "ms_panel";
    protected $primaryKey ='id';
    protected $fillable =['panel'];
}
