<?php

namespace Database\Seeders;

use Faker\Factory;
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
        $faker = Factory::create('ru_RU');

        $createdAt = $faker->dateTimeBetween('-1 month', 'now');
        $data = [
            [
                'name' => 'Администратор',
                'role_id' => 1,
                'email' => 'email@email.ru',
                'password' => Hash::make('123456'),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ],
        ];

        for ($i = 1; $i <= 10; $i++ ) {
            $createdAt = $faker->dateTimeBetween('-1 month', 'now');
            $data[] = [
                'name' => "Менеджер {$i}",
                'role_id' => 2,
                'email' => "salon{$i}@email.ru",
                'password' => Hash::make('123456'),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        for ($i = 1; $i <= 20; $i++) {
            $createdAt = $faker->dateTimeBetween('-1 month', 'now');
            $data[] = [
                'name' => "Пользователь {$i}",
                'role_id' => 2,
                'email' => "user{$i}@email.ru",
                'password' => Hash::make('123456'),
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        DB::table('users')->insert($data);
    }
}
