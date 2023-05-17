<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $fillable = ['code_number','name','phone','address','counter_shop'];
}
