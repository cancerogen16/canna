<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Категории услуг (Маникюр)
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parent_id')->default(0); // родительская категория

            $table->string('title', 100); // название категории
            $table->string('slug')->unique(); // ярлык
            $table->string('image', 255)->nullable(); // изображение
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
        Schema::dropIfExists('categories');
    }
}
