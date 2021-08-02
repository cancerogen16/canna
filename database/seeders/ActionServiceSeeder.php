<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActionServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 13; $i++) {
            $data[] = ['action_id' => $i, 'service_id' => $i];
            $data[] = ['action_id' => $i, 'service_id' => $i + 10];
            if ($i <=10) {
                $data[] = ['action_id' => $i, 'service_id' => $i + 20];
            }
        }
        DB::table('action_service')->insert($data);
    }
}
