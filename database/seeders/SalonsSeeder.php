<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SalonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $titles = ['Салон красоты Стиль', 'Частный мастер Оксана', 'Парикмахерская для всей семьи', 'Салон Ромашка', 'Салон красоты Идеал', 'Naturel Studio', 'Agency beauty studio', 'Салон красоты Маверик', 'OldBoy Barbershop', 'Barbershop BRITVA'];
        $faker = Factory::create('ru_RU');

        $i = 2;
        foreach ($titles as $title) {
            $salons[] = [
                'user_id' => $i,
                'title' => $title,
                'slug' => Str::of($title)->slug(),
                'main_photo' => $faker->imageUrl(300, 300, 'nails', true, 'haircut'),
                'city' => 'Москва',
                'address' => $faker->streetAddress(),
                'phone' => '+7495'.$faker->randomNumber(7, true),
                'worktime' => '09:00 - 20:00',
                'description' => $faker->realText(200),
                'rating' => $faker->randomDigit(),
                'created_at' => $faker->dateTimeBetween('-2 month', '-1 month'),
                'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
            ];
            $i++;
        }
        DB::table('salons')->insert($salons);
    }
}
