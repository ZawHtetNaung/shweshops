<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilterLogActivity extends Model
{
    //
    protected $fillable = [
        'price', 'url', 'method', 'ip', 'agent', 'user_id',
    ];
}
