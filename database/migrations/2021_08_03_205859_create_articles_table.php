<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('article_id');
            $table->bigInteger('category_id')->unsigned();
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->string(column:'article_name');
            $table->string(column:'description');
            $table->double(column:'price');
            $table->integer(column:'stock');
            $table->string(column:'image_path');
            $table->boolean(column:'is_active');
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
        Schema::dropIfExists('articles');
    }
}
