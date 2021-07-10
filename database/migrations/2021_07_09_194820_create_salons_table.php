<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalonsTable extends Migration
{
    /**
     * Данные салонов
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salons', function (Blueprint $table) {
            $table->id();

            $table->string('slug', 191)->unique(); // ярлык
            $table->string('main_photo'); // основное фото салона
            $table->string('address');
            $table->string('phone', 50);
            $table->string('worktime'); // время работы(можно в json)
            $table->text('description')->nullable();
            $table->integer('rating'); // рейтинг
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salons');
    }
}
