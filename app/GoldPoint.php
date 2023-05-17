<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = "gold_points";
    protected $fillable = [ 'counts','status'];
    
   
}