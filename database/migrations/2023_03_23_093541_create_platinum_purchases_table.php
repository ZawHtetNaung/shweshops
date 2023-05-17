<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlatinumPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('platinum_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('staff_id');
            $table->string('quality');
            $table->string('platinum_name');
            $table->string('platinum_type');
            $table->string('profit');
            $table->integer('platinum_price');
            $table->integer('purchase_price');
            $table->integer('selling_price');
            $table->unsignedBigInteger('category_id');
            $table->string('code_number');
            $table->integer('product_gram')->default(0);
            $table->integer('capital');
            $table->string('type');
            $table->string('remark')->default(null);
            $table->string('photo');
            $table->string('barcode_text');
            $table->integer('print_barcode')->default(0);
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
        Schema::dropIfExists('platinum_purchases');
    }
}
