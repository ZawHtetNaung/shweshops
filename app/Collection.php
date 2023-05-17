<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    //
    use SoftDeletes;
    protected $fillable=['name','shop_id','deleted_at'];
    protected $table='collection';
}
