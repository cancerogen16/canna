<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('ru_RU');

        for ($i = 1; $i <= 13; $i++) {
            $createdAt = $faker->dateTimeBetween('-1 weeks', 'now');
            $records[] = [
                'user_id' => $faker->numberBetween(2, 31),
                'service_id' => $i,
                'name' => "Клиент {$i}",
                'phone' => '+7916'.$faker->randomNumber(7, true),
                'comment' => $faker->text(200),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }
        DB::table('records')->insert($records);
    }
}
