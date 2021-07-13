<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Маникюр', 'Педикюр', 'Визажист', 'Парикмахерский зал',];

        $faker = Factory::create('ru_RU');

        foreach ($titles as $title) {
            $createdAt = $faker->dateTimeBetween('-3 months', '-2 months');

            $categories[] = [
                'title' => $title,
                'parent_id' => 0,
                'slug' => Str::of($title)->slug(),
                'description' => $faker->realText(rand(50, 200)),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        DB::table('categories')->insert($categories);
    }
}
