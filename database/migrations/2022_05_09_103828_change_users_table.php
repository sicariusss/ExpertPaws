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
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->after('id')->nullable()->comment('Фамилия');
            $table->string('name')->comment('Имя')->change();
            $table->string('patronymic')->after('name')->nullable()->comment('Отчество');
            $table->string('phone')->after('email')->nullable()->unique()->comment('Телефон');
            $table->string('address')->after('phone')->nullable()->comment('Адрес');
            $table->string('photo')->after('address')->nullable()->comment('Аватарка');
            $table->unsignedBigInteger('role_id')->after('photo')->comment('Роль');
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
        //
    }
};
