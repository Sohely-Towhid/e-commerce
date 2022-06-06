<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('catagory_id');
            $table->integer('subcatagory_id');
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('product_discount')->nullable();
            $table->integer('after_discount');
            $table->string('brand');
            $table->text('short_description');
            $table->text('description');

            $table->string('preview')->nullable();
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
        Schema::dropIfExists('products');
    }
}
