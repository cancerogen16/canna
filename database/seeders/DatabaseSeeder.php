<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(SalonsSeeder::class);
        $this->call(MastersSeeder::class);
        $this->call(ServiceSeeder::class);
    }
}
