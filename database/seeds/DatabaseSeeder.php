<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(ItemSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(Product_Details_Seeder::class);
        $this->call(CategorySeeder::class);

    }
}
