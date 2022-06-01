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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('description', 350)->comment('Отзыв');
            $table->string('image')->comment('Изображение')->nullable();
            $table->unsignedBigInteger('user_id')->comment('ID пользователя');
            $table->boolean('anon')->comment('Анонимный отзыв');
            $table->boolean('published')->comment('Опубликованный отзыв');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gallery');
    }
};
