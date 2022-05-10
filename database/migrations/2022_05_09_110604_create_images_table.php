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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('Сущность');
            $table->string('type_id')->comment('ID сущности');
            $table->string('path')->comment('Путь изображения');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('photo_id')->references('id')->on('images');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->foreign('preview_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
