<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop_owners_selection extends Model
{
    //
    protected $fillable=['user_id','selection_id'];
    public $table='shop_owners_selection';
}
