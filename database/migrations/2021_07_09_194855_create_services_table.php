<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Услуги (Детский маникюр)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id') // привязка к категории
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->foreignId('master_id') // привязка мастера к услуге
            ->constrained('masters')
                ->cascadeOnDelete();

            $table->foreignId('salon_id') // привязка к салону
            ->constrained('salons')
                ->cascadeOnDelete();

            $table->string('title', 191); // название
            $table->string('slug', 191)->unique(); // ярлык

            $table->decimal('price', 8, 0); // цена услуги
            $table->string('duration')->default(1); // количество минут для записи

            $table->string('use_break')->nullable(); // Перерыв после записи

            $table->string('image', 255)->nullable(); // изображение услуги

            $table->text('excerpt')->nullable(); // краткое описание
            $table->text('description')->nullable(); // описание

            $table->timestamps(); // created_at and updated_at
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
        Schema::dropIfExists('services');
    }
}
