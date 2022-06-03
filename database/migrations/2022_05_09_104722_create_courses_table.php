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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Название курса');
            $table->string('short_description', 1000)->comment('Короткое описание');
            $table->text('full_description')->comment('Полное описание');
            $table->integer('price')->comment('Цена');
            $table->string('preview')->comment('Превью');
            $table->string('school')->comment('Направление');
            $table->string('hours')->comment('Объем программы в часах');
            $table->string('slug')->comment('Ссылка');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
