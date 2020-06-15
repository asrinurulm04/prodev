<?php

namespace App\Modelmesin;

use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    protected $table ='fs_data';
    protected $primaryKey ='id';
    protected $fillable =['data'];
}
