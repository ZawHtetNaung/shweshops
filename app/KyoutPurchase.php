<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KyoutPurchase extends Model
{
    //
    protected $fillable = [
        'date','gold_name','supplier_id','quality_id','gold_type','staff_id',
        'purchase_price','category_id','code_number','diamond_id','photo',
        'type','gold_gram_kyat_pe_yway','diamond_gram_kyat_pe_yway','decrease_pe_yway',
        'profit_pe_yway','service_pe_yway','gold_price','decrease_price','profit','service_fee',
        'gold_fee','selling_price','diamond_selling_price','capital',
        'remark','barcode_text'
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

    public function diamond(){
        return $this->belongsTo(Diamond::class);
    }
}
