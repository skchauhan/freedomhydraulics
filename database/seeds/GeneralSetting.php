<?php

use Illuminate\Database\Seeder;

class GeneralSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('general_settings')->insert([
        	['key'=>'logo', 'value'=>'logo.jpg'],
        	['key'=>'email', 'value'=>'admin@gmail.com'],
        	['key'=>'address', 'value'=>'23 miterlok delhi 112032'], 
        	['key'=>'phone', 'value'=>'1234567895'], 
        ]);
    }
}
