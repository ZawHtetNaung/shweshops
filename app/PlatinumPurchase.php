<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlatinumPurchase extends Model
{
    //
    protected $fillable = [
        'date','quality','staff_id','platinum_name','platinum_type',
        'purchase_price','category_id','code_number',
        'product_gram','profit','platinum_price',
        'capital','selling_price',
        'remark','photo','barcode_text','type'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function staff(){
        return $this->belongsTo(Staff::class);
    }
}
