<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Зарегистрированные пользователи
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->default(3) // привязка к роли, 3-клиент, 2-салон. на фронтенде сделать выпадающее меню - салон/клиент
                ->constrained('roles')
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('password');
          //  $table->boolean('is_business')->default(false); // 0-клиент, 1-салон
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
