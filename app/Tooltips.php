<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tooltips extends Model
{
    //
    protected $table='for_tooltips';
    protected $fillable=['endpoint','info'];
}
