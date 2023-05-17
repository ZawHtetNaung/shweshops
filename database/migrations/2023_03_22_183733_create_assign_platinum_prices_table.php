<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignPlatinumPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_platinum_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('gradeA');
            $table->integer('gradeB');
            $table->integer('gradeC');
            $table->integer('gradeD');
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
        Schema::dropIfExists('assign_platinum_prices');
    }
}
