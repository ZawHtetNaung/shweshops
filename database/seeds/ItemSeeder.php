<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'id' => 1,
                'photo_one' => 'images/shop/ring.jpg',
                'photo_two' => 'images/shop/shwe.jpg',
                'photo_three' => 'images/shop/ring.jpg',
                'photo_four' => 'images/shop/ring.jpg',
                'photo_five' => 'images/shop/ring.jpg',
                'photo_six' => 'images/shop/ring.jpg',
                'photo_seven' => 'images/shop/ring.jpg',
                'photo_eight' => 'images/shop/ring.jpg',
                'photo_nine' => 'images/shop/ring.jpg',
                'photo_ten' => 'images/shop/ring.jpg',
                'default_photo' => 'default photo',
                'name' => 'ring',
                'price' => 'Range',
                'min_price' => '15000',
                'max_price' => '250000',
                'description' => 'so bright',
                'shop_id' => '1',
                'gold_quality' => '18K Au750',
                'gold_colour' => 'White Gold',
                'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
                'အထည်မပျက်_ပြန်သွင်း' => '20%',
                'တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ' => '15%',
                'အထည်ပျက်စီးချို့ယွင်း' => '30%',
                'weight' => '5.33',
                'weight_unit' => 'Gram',
                'review' => 'so bright',
                'stock' => 'In stock',
                'category_id' => '1',

            ],
            // [
            //     'id' => 2,
            //     'photo_one' => 'images/shop/ring.jpg',
            //     'photo_two' => 'images/shop/shwe.jpg',
            //     'photo_three' => 'images/shop/ring.jpg',
            //     'photo_four' => 'images/shop/ring.jpg',
            //     'photo_five' => 'images/shop/ring.jpg',
            //     'photo_six' => 'images/shop/ring.jpg',
            //     'photo_seven' => 'images/shop/ring.jpg',
            //     'photo_eight' => 'images/shop/ring.jpg',
            //     'photo_nine' => 'images/shop/ring.jpg',
            //     'photo_ten' => 'images/shop/ring.jpg',
            //     'name' => 'ring',
            //     'price' => '15000ks',
            //     'description' => 'so bright',
            //     'shop_id' => '2',
            //     'gold_quality' => '18K Au750',
            //     'gold_colour' => 'White Gold',
            //     'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
            //     'အထည်မပျက်_ပြန်သွင်း' => '20%',
            //     'တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ' => '15%',
            //     'အထည်ပျက်စီးချို့ယွင်း' => '30%',
            //     'weight' => '5.33g',
            //     'review' => 'so bright',
            //     'stock' => '2',
            //     'category_id' => '2',

            // ],
            // [
            //     'id' => 3,
            //     'photo_one' => 'images/shop/ring.jpg',
            //     'photo_two' => 'images/shop/shwe.jpg',
            //     'photo_three' => 'images/shop/ring.jpg',
            //     'photo_four' => 'images/shop/ring.jpg',
            //     'photo_five' => 'images/shop/ring.jpg',
            //     'photo_six' => 'images/shop/ring.jpg',
            //     'photo_seven' => 'images/shop/ring.jpg',
            //     'photo_eight' => 'images/shop/ring.jpg',
            //     'photo_nine' => 'images/shop/ring.jpg',
            //     'photo_ten' => 'images/shop/ring.jpg',
            //     'name' => 'ring',
            //     'price' => '15000ks',
            //     'description' => 'so bright',
            //     'shop_id' => '3',
            //     'gold_quality' => '18K Au750',
            //     'gold_colour' => 'White Gold',
            //     'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
            //     'အထည်မပျက်_ပြန်သွင်း' => '20%',
            //     'တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ' => '15%',
            //     'အထည်ပျက်စီးချို့ယွင်း' => '30%',
            //     'weight' => '5.33g',
            //     'review' => 'so bright',
            //     'stock' => '2',
            //     'category_id' => '3',

            // ],
            // [
            //     'id' => 4,
            //     'photo_one' => 'images/shop/ring.jpg',
            //     'photo_two' => 'images/shop/shwe.jpg',
            //     'photo_three' => 'images/shop/ring.jpg',
            //     'photo_four' => 'images/shop/ring.jpg',
            //     'photo_five' => 'images/shop/ring.jpg',
            //     'photo_six' => 'images/shop/ring.jpg',
            //     'photo_seven' => 'images/shop/ring.jpg',
            //     'photo_eight' => 'images/shop/ring.jpg',
            //     'photo_nine' => 'images/shop/ring.jpg',
            //     'photo_ten' => 'images/shop/ring.jpg',
            //     'name' => 'ring',
            //     'price' => '15000ks',
            //     'description' => 'so bright',
            //     'shop_id' => '1',
            //     'gold_quality' => '18K Au750',
            //     'gold_colour' => 'White Gold',
            //     'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
            //     'အထည်မပျက်_ပြန်သွင်း' => '20%',
            //     'ph' => '15%',
            //     'အထည်ပျက်စီးချို့ယွင်း' => '30%',
            //     'weight' => '5.33g',
            //     'review' => 'so bright',
            //     'stock' => '2',
            //     'category_id' => '1',

            // ],
            // [
            //     'id' => 5,
            //     'photo_one' => 'images/shop/ring.jpg',
            //     'photo_two' => 'images/shop/shwe.jpg',
            //     'photo_three' => 'images/shop/ring.jpg',
            //     'photo_four' => 'images/shop/ring.jpg',
            //     'photo_five' => 'images/shop/ring.jpg',
            //     'photo_six' => 'images/shop/ring.jpg',
            //     'photo_seven' => 'images/shop/ring.jpg',
            //     'photo_eight' => 'images/shop/ring.jpg',
            //     'photo_nine' => 'images/shop/ring.jpg',
            //     'photo_ten' => 'images/shop/ring.jpg',
            //     'name' => 'ring',
            //     'price' => '15000ks',
            //     'description' => 'so bright',
            //     'shop_id' => '2',
            //     'gold_quality' => '18K Au750',
            //     'gold_colour' => 'White Gold',
            //     'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
            //     'အထည်မပျက်_ပြန်သွင်း' => '20%',
            //     'တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ' => '15%',
            //     'အထည်ပျက်စီးချို့ယွင်း' => '30%',
            //     'weight' => '5.33g',
            //     'review' => 'so bright',
            //     'stock' => '2',
            //     'category_id' => '2',

            // ],
            // [
            //     'id' => 6,
            //     'photo_one' => 'images/shop/ring.jpg',
            //     'photo_two' => 'images/shop/shwe.jpg',
            //     'photo_three' => 'images/shop/ring.jpg',
            //     'photo_four' => 'images/shop/ring.jpg',
            //     'photo_five' => 'images/shop/ring.jpg',
            //     'photo_six' => 'images/shop/ring.jpg',
            //     'photo_seven' => 'images/shop/ring.jpg',
            //     'photo_eight' => 'images/shop/ring.jpg',
            //     'photo_nine' => 'images/shop/ring.jpg',
            //     'photo_ten' => 'images/shop/ring.jpg',
            //     'name' => 'ring',
            //     'price' => '15000ks',
            //     'description' => 'so bright',
            //     'shop_id' => '3',
            //     'gold_quality' => '18K Au750',
            //     'gold_colour' => 'White Gold',
            //     'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
            //     'အထည်မပျက်_ပြန်သွင်း' => '20%',
            //     'တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ' => '15%',
            //     'အထည်ပျက်စီးချို့ယွင်း' => '30%',
            //     'weight' => '5.33g',
            //     'review' => 'so bright',
            //     'stock' => '2',
            //     'category_id' => '3',

            // ],
            // [
            //     'id' => 7,
            //     'photo_one' => 'images/shop/ring.jpg',
            //     'photo_two' => 'images/shop/shwe.jpg',
            //     'photo_three' => 'images/shop/ring.jpg',
            //     'photo_four' => 'images/shop/ring.jpg',
            //     'photo_five' => 'images/shop/ring.jpg',
            //     'photo_six' => 'images/shop/ring.jpg',
            //     'photo_seven' => 'images/shop/ring.jpg',
            //     'photo_eight' => 'images/shop/ring.jpg',
            //     'photo_nine' => 'images/shop/ring.jpg',
            //     'photo_ten' => 'images/shop/ring.jpg',
            //     'name' => 'ring',
            //     'price' => '15000ks',
            //     'description' => 'so bright',
            //     'shop_id' => '1',
            //     'gold_quality' => '18K Au750',
            //     'gold_colour' => 'White Gold',
            //     'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
            //     'အထည်မပျက်_ပြန်သွင်း' => '20%',
            //     'တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ' => '15%',
            //     'အထည်ပျက်စီးချို့ယွင်း' => '30%',
            //     'weight' => '5.33g',
            //     'review' => 'so bright',
            //     'stock' => '2',
            //     'category_id' => '1',

            // ],
            // [
            //     'id' => 8,
            //     'photo_one' => 'images/shop/ring.jpg',
            //     'photo_two' => 'images/shop/shwe.jpg',
            //     'photo_three' => 'images/shop/ring.jpg',
            //     'photo_four' => 'images/shop/ring.jpg',
            //     'photo_five' => 'images/shop/ring.jpg',
            //     'photo_six' => 'images/shop/ring.jpg',
            //     'photo_seven' => 'images/shop/ring.jpg',
            //     'photo_eight' => 'images/shop/ring.jpg',
            //     'photo_nine' => 'images/shop/ring.jpg',
            //     'photo_ten' => 'images/shop/ring.jpg',
            //     'name' => 'ring',
            //     'price' => '15000ks',
            //     'description' => 'so bright',
            //     'shop_id' => '2',
            //     'gold_quality' => '18K Au750',
            //     'gold_colour' => 'White Gold',
            //     'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
            //     'အထည်မပျက်_ပြန်သွင်း' => '20%',
            //     'တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ' => '15%',
            //     'အထည်ပျက်စီးချို့ယွင်း' => '30%',
            //     'weight' => '5.33g',
            //     'review' => 'so bright',
            //     'stock' => '2',
            //     'category_id' => '2',

            // ],
            // [
            //     'id' => 9,
            //     'photo_one' => 'images/shop/ring.jpg',
            //     'photo_two' => 'images/shop/shwe.jpg',
            //     'photo_three' => 'images/shop/ring.jpg',
            //     'photo_four' => 'images/shop/ring.jpg',
            //     'photo_five' => 'images/shop/ring.jpg',
            //     'photo_six' => 'images/shop/ring.jpg',
            //     'photo_seven' => 'images/shop/ring.jpg',
            //     'photo_eight' => 'images/shop/ring.jpg',
            //     'photo_nine' => 'images/shop/ring.jpg',
            //     'photo_ten' => 'images/shop/ring.jpg',
            //     'name' => 'ring',
            //     'price' => '15000ks',
            //     'description' => 'so bright',
            //     'shop_id' => '3',
            //     'gold_quality' => '18K Au750',
            //     'gold_colour' => 'White Gold',
            //     'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
            //     'အထည်မပျက်_ပြန်သွင်း' => '20%',
            //     'တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ' => '15%',
            //     'အထည်ပျက်စီးချို့ယွင်း' => '30%',
            //     'weight' => '5.33g',
            //     'review' => 'so bright',
            //     'stock' => '2',
            //     'category_id' => '3',

            // ],
            // [
            //     'id' => 10,
            //     'photo_one' => 'images/shop/ring.jpg',
            //     'photo_two' => 'images/shop/shwe.jpg',
            //     'photo_three' => 'images/shop/ring.jpg',
            //     'photo_four' => 'images/shop/ring.jpg',
            //     'photo_five' => 'images/shop/ring.jpg',
            //     'photo_six' => 'images/shop/ring.jpg',
            //     'photo_seven' => 'images/shop/ring.jpg',
            //     'photo_eight' => 'images/shop/ring.jpg',
            //     'photo_nine' => 'images/shop/ring.jpg',
            //     'photo_ten' => 'images/shop/ring.jpg',
            //     'name' => 'ring',
            //     'price' => '15000ks',
            //     'description' => 'so bright',
            //     'shop_id' => '1',
            //     'gold_quality' => '18K Au750',
            //     'gold_colour' => 'White Gold',
            //     'sizing_guide' => 'လက်ကောက်ဝတ်ဆိုဒ်အတိုင်း 16cm မှ 17cm ထိဝတ်ဆင်နိုင်ပါသည်',
            //     'အထည်မပျက်_ပြန်သွင်း' => '20%',
            //     'တန်ဖိုးမြင့်အထည်_နှင့်_အထည်မပျက်ပြန်လဲ' => '15%',
            //     'အထည်ပျက်စီးချို့ယွင်း' => '30%',
            //     'weight' => '5.33g',
            //     'review' => 'so bright',
            //     'stock' => '2',
            //     'category_id' => '1',

            // ],


        ];

        Item:: insert($items);
    }
}