<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productdetails extends Model
{
    //
    protected $fillable=['id','name'];
    public $table='product_details';

}
