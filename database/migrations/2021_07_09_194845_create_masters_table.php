<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMastersTable extends Migration
{
    /**
     * Мастера
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('salon_id') // привязка к салону
                ->constrained('salons')
                ->cascadeOnDelete();

            $table->string('name', 191); // имя
            $table->string('slug', 191)->unique(); // ярлык

            $table->string('photo', 255)->nullable(); // фото

            $table->string('experience', 255)->nullable(); // опыт

            $table->text('description')->nullable(); // описание

            $table->integer('rating')->default(0); // рейтинг

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
        Schema::dropIfExists('masters');
    }
}
