<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPoint extends Model
{
    protected $table = "user_points";
    protected $fillable = [ 'user_id','point_id','product_id'];
}
