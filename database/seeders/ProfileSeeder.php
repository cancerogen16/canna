<?php

namespace Database\Seeders;

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
        $data = [
            [
                'user_id' => 1,
                'name' => 'Иван Иванов',
                'photo' => 'https://avatars.mds.yandex.net/get-kinopoisk-image/1704946/abe7bf78-316f-42dd-b2dd-131c4215f7a1/360',
                'address' => 'Москва, ул. Арбат, д. 1',
                'email' => 'ivan@canna.ru',
                'about' => 'администратор Canna',
            ]
        ];

        DB::table('profiles')->insert($data);
    }
}
