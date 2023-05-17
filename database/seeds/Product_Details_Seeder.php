<?php

use Illuminate\Database\Seeder;
use App\Productdetails;

class Product_Details_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_details = [
            [
                'id' => 1,
                'name' => 'gold',
            ],

            [
                'id' => 2,
                'name' => 'paltinum',
            ],

            [
                'id' => 3,
                'name' => 'silver',
            ],
        ];

        Productdetails:: insert($product_details);
    }
}
