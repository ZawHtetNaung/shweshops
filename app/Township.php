<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Township extends Model
{
    //
    protected  $table='township';
    protected $fillable=['name', 'myan_name','state_id'];
}
