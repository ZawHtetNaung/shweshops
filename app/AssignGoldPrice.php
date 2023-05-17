<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignGoldPrice extends Model
{
    //
    protected $fillable = ['date','open_price','shop_price','price_16',
    'outprice_15','inprice_15',
    'outprice_14','inprice_14',
    'outprice_14_2','inprice_14_2',
    'outprice_13','inprice_13',
    'outprice_12','inprice_12',
    'outprice_12_2','inprice_12_2',
    ];
}
