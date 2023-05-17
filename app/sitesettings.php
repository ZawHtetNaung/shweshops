<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sitesettings extends Model
{
    //
    public $table='sitesettings';
    public $fillable=['name','action'];
    public $timestamps = false;
}
