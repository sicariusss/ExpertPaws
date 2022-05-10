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
            $table->string('short_description')->comment('Короткое описание');
            $table->text('full_description')->comment('Полное описание');
            $table->integer('price')->comment('Цена');
            $table->unsignedBigInteger('preview_id')->comment('Превью');
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
        Schema::dropIfExists('courses');
    }
};
