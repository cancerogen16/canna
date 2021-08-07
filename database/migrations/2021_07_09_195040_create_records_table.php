<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Записи клиентов к мастерам
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id') // привязка к пользователю, который создал запись (не обязательно клиент)
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('service_id') // привязка к услуге
                ->constrained('services')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('phone');
            $table->text('comment')->nullable();

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
        Schema::dropIfExists('records');
    }
}
