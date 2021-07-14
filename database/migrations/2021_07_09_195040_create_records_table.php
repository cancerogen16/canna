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

            $table->foreignId('user_id') // привязка к пользователю
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('calendar_id') // привязка к пункту в календаре
                ->constrained('calendars')
                ->cascadeOnDelete();

            $table->string('comment')->nullable();

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
        Schema::dropIfExists('records');
    }
}
