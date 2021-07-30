<?php

namespace Database\Seeders;

use App\Models\Record;
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

        for ($i = 1; $i <= 13; $i++) {
            $duration = Record::find($i)->service()->first()->duration;
            for ($j = 2; $j <= 10; $j++) {
                if ($j - 2 < $duration) {
                    $record_id = $i;
                } else {
                    $record_id = null;
                }
                $calendars[] = [
                    'master_id' => $i,
                    'record_id' => $record_id,
                    'start_datetime' => $faker->dateTimeBetween("+{$i} days {$j} hours", "+{$i} days {$j} hours")
                                        ->format('Y-m-d H'),
                    'created_at' => $faker->dateTimeBetween('-2 weeks', '-1 week'),
                    'updated_at' => $faker->dateTimeBetween('-1 week', 'now'),
                ];
            }
        }
        DB::table('calendars')->insert($calendars);
    }
}
