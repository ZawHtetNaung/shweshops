<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usersorshopsonlinestatus extends Model
{
    //

    protected $table = 'online_status';

    protected $fillable = [
        'users_id','shops_id','role','status'
    ];

}
