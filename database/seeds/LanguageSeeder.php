<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([['code'=>'en', 'name'=>'English', 'status'=>1], ['code'=>'fr', 'name'=>'French', 'status'=>1]]);
    }
}
