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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Название');
            $table->unsignedBigInteger('course_id')->comment('Курс, которому принадлежит глава');
            $table->string('icon')->comment('Иконка');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('course_id')->references('id')->on('courses');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('chapter_id')->comment('Глава, которой принадлежит урок')->after('content');

            $table->foreign('chapter_id')->references('id')->on('chapters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
};
