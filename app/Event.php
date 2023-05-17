<?php

namespace App;

use App\Shopowner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    
    protected $table = "events";
  
    protected $fillable = ['shop_id','slug','title','description','deleted_at'];

    protected $date = ['deleted_at'];

    public function getShop()
    {
        return $this->belongsTo(Shopowner::class,'shop_id');
    }
}
