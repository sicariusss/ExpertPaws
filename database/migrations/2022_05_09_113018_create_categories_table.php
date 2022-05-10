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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название');
            $table->text('description')->comment('Описание')->nullable();
            $table->unsignedBigInteger('preview_id')->comment('Превью');
            $table->unsignedBigInteger('parent_id')->comment('Родитель')->nullable();
            $table->timestamps();

            $table->foreign('preview_id')->references('id')->on('images');
            $table->foreign('parent_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
