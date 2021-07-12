<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Администратор',
                'role_id' => 1,
                'phone' => '71111111111',
                'password' => Hash::make('123456'),
                'is_business' => 0
            ],
            [
                'name' => 'Менеджер',
                'role_id' => 2,
                'phone' => '72222222222',
                'password' => Hash::make('123456'),
                'is_business' => 0
            ],
        ];

        DB::table('users')->insert($data);
    }
}
