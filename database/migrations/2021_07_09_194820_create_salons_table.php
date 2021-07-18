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

            $table->foreignId('user_id') // привязка к таблице users
            ->constrained('users')
                ->cascadeOnDelete();

            $table->string('title', 191); // название салона
            $table->string('slug', 191)->unique(); // ярлык
            $table->string('main_photo')->nullable(); // основное фото салона
            $table->string('city')->index();
            $table->string('address');
            $table->string('phone', 50);
            $table->string('worktime'); // время работы(можно в json)
            $table->text('description')->nullable();
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
        Schema::dropIfExists('salons');
    }
}
