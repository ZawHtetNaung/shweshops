<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class facebooktable extends Model
{
    //
    use SoftDeletes;
    protected $table='facebook';
    protected $fillable=['fb_user_id','page_id','shop_owner_id','longliveusertoken','longlivepagetoken','pagename','shop_id','deleted_at'];
}
