<?php

use Illuminate\Database\Seeder;
use App\Categories;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'ring',
            ],

            [
                'id' => 2,
                'name' => 'necklaces',
            ],

            [
                'id' => 3,
                'name' => 'earring',
            ],
        ];

        Categories:: insert($categories);
    }
}
