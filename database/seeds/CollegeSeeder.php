<?php

use Illuminate\Database\Seeder;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colleges')->insert([
            'title' => 'Kathmandu BernHardt College',
            'Description' => 'A college with a human Heart',
            'address' => 'Bafal, Kathmandu',
            'contact' => 014032545,
            'email' => 'infp@kbc.edu.np'
        ]);

        DB::table('colleges')->insert([
            'title' => 'The British College',
            'Description' => 'Providing British Degree',
            'address' => 'Thapathali, Kathmandu',
            'contact' => 014045545,
            'email' => 'infp@thebritish.edu.np'
        ]);

        DB::table('colleges')->insert([
            'title' => 'Amrit Science(ASCOL) College',
            'Description' => 'A college with quality education',
            'address' => 'Kathmandu',
            'contact' => 014032545,
            'email' => 'infp@ascol.edu.np'
        ]);
    }
}
