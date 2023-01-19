<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->foreignId('store_id')->references('id')->on('stores')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 60);
            $table->string('desc', 300)->nullable();
            $table->integer('price');
            $table->string('image', 200);
            $table->foreignId('category_id')->references('id')->on('products_categories')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('active')->default(true);
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
};
