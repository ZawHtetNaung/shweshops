<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //

    protected $fillable = [
        'date','supplier_id','quality_id','staff_id','gold_name',
        'purchase_price','category_id','code_number',
        'product_gram_kyat_pe_yway','service_pe_yway','gold_price',
        'decrease_pe_yway','profit_pe_yway','decrease_price',
        'gold_fee','profit','service_fee','selling_price',
        'gold_type','remark','photo','barcode_text','type'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function quality(){
        return $this->belongsTo(PosQuality::class);
    }

    public function staff(){
        return $this->belongsTo(Staff::class);
    }
}
