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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('content', 1000)->comment('Вопрос');
            $table->unsignedBigInteger('lesson_id')->comment('Урок');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('lesson_id')->references('id')->on('lessons');
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('content', 1000)->comment('Ответ');
            $table->boolean('correct')->comment('Правильный - 1, Не правильный - 0');
            $table->unsignedBigInteger('question_id')->comment('Вопрос');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('question_id')->references('id')->on('questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('answers');
    }
};
