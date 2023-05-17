<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKyoutPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyout_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->unsignedBigInteger('supplier_id');
            $table->integer('phone');
            $table->string('quality');
            $table->integer('purchase_price');
            $table->unsignedBigInteger('category_id');
            $table->string('code_number');
            $table->string('product_gram_kyat_pe_yway');
            $table->string('diamondk_kyat_pe_yway');
            $table->string('gold_kyat_pe_yway');
            $table->string('purchase_decrease_kyat_pe_yway');
            $table->string('sell_decrease_kyat_pe_yway');
            $table->integer('gold_price');
            $table->integer('gold_fee');
            $table->integer('capital');
            $table->integer('diamondk_price');
            $table->integer('service_fee');
            $table->string('type');
            $table->string('remark')->default(null);
            $table->string('photo');
            $table->string('barcode_text');
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
        Schema::dropIfExists('kyout_purchases');
    }
}
