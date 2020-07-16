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
            $table->unsignedBigInteger('id');
            $table->string('brand')->nullable();
            $table->string('sku')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->integer('qty')->default('0');
            $table->decimal('weight',8,2)->default('0.00');
            $table->decimal('price',8,2)->default('0');
            $table->decimal('sale_price',8,2)->default('0');
            $table->tinyInteger('status')->default('1');
            $table->string('ratings')->nullable();
            $table->bigIncrements('shop_id');
            $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');

            $table->tinyInteger('featured')->nullable();


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
