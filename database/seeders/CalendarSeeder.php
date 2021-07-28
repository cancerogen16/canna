<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CalendarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 30; $i++) {
            for ($j = 2; $j <= 10; $j++) {
                $calendars[] = [
                    'service_id' => $i,
                    'start_datetime' => $faker->dateTimeBetween("+{$j} days 1 hour", "+{$j} days 3 hours")
                                        ->format('Y-m-d H'),
                    'end_datetime' => $faker->dateTimeBetween("+{$j} days 4 hours", "+{$j} days 6 hours")
                                        ->format('Y-m-d H'),
                    'created_at' => $faker->dateTimeBetween('-2 weeks', '-1 week'),
                    'updated_at' => $faker->dateTimeBetween('-1 week', 'now'),
                ];
            }
        }
        DB::table('calendars')->insert($calendars);
    }
}
