<?php

namespace App\devnf;

use Illuminate\Database\Eloquent\Model;

class panel extends Model
{
    protected $table = "panel";
    protected $primaryKey ='id';
    protected $fillable =['panel'];
}
