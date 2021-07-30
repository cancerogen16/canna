<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    /**
     * Таблица с доступным временем записи по салонам/услугам.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) { //календарь с расписанием мастера

            $table->id();

            $table->foreignId('master_id') // привязка к мастеру
                ->constrained('masters')
                ->cascadeOnDelete();

            $table->foreignId('record_id') // привязка к записи
                ->nullable()
                ->default(null)
                ->constrained('records');

            $table->dateTime('start_datetime'); // время начала

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
        Schema::dropIfExists('calendars');
    }
}
