<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_selection extends Model
{
    //
    protected $fillable=['user_id','selection_id'];
    public $table='users_selection';
}
