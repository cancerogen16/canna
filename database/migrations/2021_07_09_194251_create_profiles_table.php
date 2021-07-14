<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Профили зарегистрированных пользователей
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id') // привязка к таблице users
                ->constrained('users')
                ->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('about')->nullable(); // о себе
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
        Schema::dropIfExists('profiles');
    }
}
