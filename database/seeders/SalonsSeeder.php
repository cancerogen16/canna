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


        foreach ($titles as $title) {
            $salons[] = [
                'user_id' => 1,
                'title' => $title,
                'slug' => Str::of($title)->slug(),
                'main_photo' => $faker->imageUrl(300, 300, 'nails', true, 'haircut'),
                'city' => 'Москва',
                'address' => $faker->streetAddress(),
                'phone' => '+7495'.$faker->randomNumber(7, true),
                'worktime' => '09:00 - 20:00',
                'description' => $faker->text(200),
                'rating' => $faker->randomDigit(),

            ];
        }
        DB::table('salons')->insert($salons);
    }
}
