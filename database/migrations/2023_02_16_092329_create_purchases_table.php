<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('supplier_id');
            $table->string('quality');
            $table->integer('gold_price');
            $table->integer('purchase_price');
            $table->unsignedBigInteger('category_id');
            $table->string('code_number');
            $table->integer('product_gram')->default(0);
            $table->integer('product_kyat')->default(0);
            $table->integer('product_pe')->default(0);
            $table->integer('product_yway')->default(0);
            $table->integer('decrease_price');
            $table->integer('gold_fee');
            $table->integer('capital');
            $table->integer('service_fee');
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
        Schema::dropIfExists('purchases');
    }
}
