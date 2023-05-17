<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class facebookmessage extends Model
{
    //
    protected $collection='facebookmessages';
    protected $connection='mongodb';
    protected $fillable=['user_fb_id','shop_id','user_id'];

}
