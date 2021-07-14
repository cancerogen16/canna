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
        $cities = ['Москва', 'Санкт-Петербург', 'Екатеринбург', 'Воронеж',];

        $faker = Factory::create('en_US');

        foreach ($cities as $city) {
            $salons[] = [
                'slug' => Str::of($city)->slug(),
                'main_photo' => $faker->imageUrl(300, 300, 'nails', true, 'haircut'),
                'city' => $city,
                'address' => $faker->word().$faker->randomDigit(),
                'phone' => $faker->randomNumber(5, true),
                'worktime' => $faker->randomDigit(),
                'description' => $faker->text(200),
                'rating' => $faker->randomDigit(),

            ];
        }
        DB::table('salons')->insert($salons);
    }
}
