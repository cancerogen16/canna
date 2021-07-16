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
                'email' => 'email@email.ru',
                'password' => Hash::make('123456'),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
