<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemLogActivity extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'item_id','shop_id','item_code','name','user_id','user_name','deleted_at'
    ];
}
