<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название');
            $table->text('description')->comment('Описание')->nullable();
            $table->integer('price')->comment('Цена');
            $table->integer('manufacturer')->comment('Производитель')->nullable();
            $table->unsignedBigInteger('preview_id')->comment('Превью');
            $table->unsignedBigInteger('category_id')->comment('Категория');
            $table->timestamps();

            $table->foreign('preview_id')->references('id')->on('images');
            $table->foreign('category_id')->references('id')->on('categories');
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