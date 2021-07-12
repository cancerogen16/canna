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

            $table->foreignId('salon_id') // привязка к салону
                ->constrained('salons')
                ->cascadeOnDelete();
            $table->foreignId('master_id') // привязка к мастеру
                ->constrained('masters')
                ->cascadeOnDelete();
            $table->foreignId('service_id') // привязка к услуге
                ->constrained('services')
                ->cascadeOnDelete();

            $table->string('name', 255); // название акции

            $table->string('photo', 255)->nullable();

            $table->text('description')->nullable(); // описание акции

            $table->decimal('price', 8, 0); // цена по акции

            $table->timestamp('start_at'); // начало акции
            $table->timestamp('end_at'); // окончание акции

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
