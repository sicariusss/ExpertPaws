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
        Schema::create('callbacks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Имя отправителя');
            $table->string('email')->comment('Почта отправителя');
            $table->string('subject')->comment('Тема сообщения');
            $table->text('message')->comment('Сообщение');
            $table->unsignedBigInteger('user_id')->nullable()->comment('ID пользователя, null - если не авторизирован');
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
        Schema::dropIfExists('callbacks');
    }
};
