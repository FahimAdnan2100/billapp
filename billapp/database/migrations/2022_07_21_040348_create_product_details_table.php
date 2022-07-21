<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('date');
            $table->integer('billNo');
            $table->integer('customerId');
            $table->integer('productId');
            $table->decimal('qty');
            $table->decimal('rate');
            $table->decimal('totalAmount');
            $table->decimal('discount');
            $table->decimal('netAmount');
            $table->decimal('paidAmount');

            $table->decimal('discountTotal');
            $table->decimal('netTotal');
            $table->decimal('dueAmount');
            $table->integer('status');
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
        Schema::dropIfExists('product_details');
    }
}
