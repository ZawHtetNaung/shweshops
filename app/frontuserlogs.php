<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class frontuserlogs extends Model
{
    //
    protected $table='front_user_logs';
    protected $fillable=['userorguestid','visited_link','product_id','shop_id','status','ads_id'];
}
