<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTable extends Migration
{
    /**
     * Акции салона
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('service_id') // привязка к услуге
                ->constrained('services')
                ->cascadeOnDelete();

            $table->string('name', 255); // название акции

            $table->string('photo', 255)->nullable();

            $table->text('description')->nullable(); // описание акции

            $table->decimal('price', 8, 0); // цена по акции

            $table->dateTime('start_at'); // начало акции
            $table->dateTime('end_at'); // окончание акции

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
        Schema::dropIfExists('actions');
    }
}
