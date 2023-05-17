<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignGoldPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_gold_prices', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->integer('open_price');
            $table->integer('shop_price');
            $table->integer('gold_price');
            $table->integer('price_16');
            $table->integer('price_15');
            $table->integer('price_14_2');
            $table->integer('price_14');
            $table->integer('price_13');
            $table->integer('price_12_2');
            $table->integer('price_12');
            $table->integer('price_11_2');
            $table->integer('price_11');
            $table->integer('price_10');
            $table->integer('price_9');
            $table->integer('price_8_2');
            $table->integer('price_8');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assign_gold_prices');
    }
}
