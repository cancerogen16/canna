<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');

        $data = [
            [
                'user_id' => 1,
                'name' => 'Иван Иванов',
                'photo' => 'https://avatars.mds.yandex.net/get-kinopoisk-image/1704946/abe7bf78-316f-42dd-b2dd-131c4215f7a1/360',
                'address' => $faker->address(),
                'phone' => $faker->phoneNumber(),
                'about' => $faker->realText(200),
                'created_at' => $faker->dateTimeBetween('-1 month', '-2 weeks'),
                'updated_at' => $faker->dateTimeBetween('-2 weeks'),
            ]
        ];

        DB::table('profiles')->insert($data);
    }
}
