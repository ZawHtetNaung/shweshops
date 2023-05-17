<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopOwnerGoldPoint extends Model
{
    protected $table = 'user_gold_point';

    protected $fillable = ['name','phone','point'];
}
