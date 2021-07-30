<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class MastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create('ru_RU');
        $names   = ['Оксана', 'Елена Николаевна', 'Ольга', 'Евгения', 'Александра Сергеевна', 'Ульяна', 'Наталья', 'Катя', 'Вера Иванова', 'Ксения', 'Лариса', 'Екатерина', 'Мария Евгеньевна'];

        $i = 1;
        foreach ($names  as $name) {

        $data = [
            [
                'salon_id' => ($i<=10) ? $i++ : ($i++ - 10),
                'name' => $name,
                'slug' => Str::of($name)->slug(),
                'position' => $faker->jobTitle(),
                'photo' => 'https://sun1-54.userapi.com/s/v1/if1/5Ir5r-6Y2bxqtAq48yrT9XDm25VGyPuxlXI1iwfzge4_ewW9lvwlmsTtZx87gILouxX4zwGp.jpg?size=400x0&quality=96&crop=205,0,541,541&ava=1',
                'experience' => $faker->randomDigit().' лет',
                'description' => $faker->realText(),
                'rating' => $faker->randomDigit(),
                'created_at' => $faker->dateTimeBetween('-2 weeks', '-1 week'),
                'updated_at' => $faker->dateTimeBetween('-1 week'),
            ]
        ];

        DB::table('masters')->insert($data);

        }
    }

}
