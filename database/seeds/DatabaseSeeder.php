<?php

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
        DB::table('users')->insert([
            'name' => 'admin',
            'user_role' => 'admin',
            'email_verified_at' => '2019-03-20 00:00:00',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        $this->call([
            RolesSeeder::class,
            GeneralSetting::class,
            LanguageSeeder::class,
            ProductTabSeed::class
        ]);
    }
}
