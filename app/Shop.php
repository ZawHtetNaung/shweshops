<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $fillable=['id','name','photo_one','photo_two','photo_three','title','description','user_id'];
}
