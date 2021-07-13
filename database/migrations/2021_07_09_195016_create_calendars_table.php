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
        Schema::create('calendars', function (Blueprint $table) { //календарь со списком услуг для записи

            $table->id();

            $table->foreignId('service_id') // привязка к услуге
            ->constrained('services')
                ->cascadeOnDelete();

            $table->dateTime('start_datetime'); // время начала

            $table->dateTime('end_datetime'); // время окончания

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
