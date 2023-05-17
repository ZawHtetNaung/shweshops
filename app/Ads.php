<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ads extends Model
{
    use SoftDeletes;
    protected $table = "ads";
    protected $fillable = [ 'name','shop_id','image','video','start','end','deleted_at'];
}
