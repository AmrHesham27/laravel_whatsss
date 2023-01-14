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
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->foreignId('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 60);
            $table->string('url', 60)->nullable();
            $table->string('logo', 200)->nullable();
            $table->string('color_1', 60)->default('rgb(246, 246, 246)');
            $table->string('color_2', 60)->default('rgb(0, 152, 0)');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->boolean('is_suspended')->default(false);
            $table->string('whatsapp', 60);
            $table->string('subdomain', 100)->nullable();
            $table->string('currency', 7)->default('E£');
            $table->boolean('displayCards')->default(false);

            $table->boolean('dinIn')->default(false);
            $table->boolean('pickUp')->default(false);
            $table->json('deliveryPlaces')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
