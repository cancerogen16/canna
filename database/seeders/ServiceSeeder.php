<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');

        for ($i = 1; $i <= 30; $i++) {
            $title = "Услуга {$i}";
            $createdAt = $faker->dateTimeBetween('-2 months', '-1 month');
            $services[] = [
                'category_id' => $faker->numberBetween(1, 4),
                'master_id' => $faker->numberBetween(1,13),
                'title' => $title,
                'slug' => Str::of($title)->slug(),
                'price' => $faker->numberBetween(500,10000),
                'duration' => $faker->numberBetween(30, 180),
                'use_break' => $faker->numberBetween(10, 30),
                'image' => $faker->imageUrl(300, 300, 'services', true, $title),
                'excerpt' => $faker->realText(100),
                'description' => $faker->realText(500),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }
        DB::table('services')->insert($services);
    }
}
