<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = ['date','code_number','name','shop_name','shop_type','phone','other_phone','state_id','township_id','address','remark','type','count'];

    public function state(){
        return $this->belongsTo(State::class);
    }
    public function township(){
        return $this->belongsTo(Township::class);
    }
}
