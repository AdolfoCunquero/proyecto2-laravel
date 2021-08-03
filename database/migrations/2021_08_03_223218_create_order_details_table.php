<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('order_detail_id');
            $table->bigInteger(column:'order_id')->unsigned();
            $table->bigInteger(column:'article_id')->unsigned();
            $table->integer('quantity');
            $table->decimal('unit_price',18,2);
            $table->boolean(column:'is_active');
            $table->timestamps();
            $table->foreign('article_id')->references('article_id')->on('articles');
            $table->foreign('order_id')->references('order_id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
