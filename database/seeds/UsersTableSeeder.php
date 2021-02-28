<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'tel' => '08085300980',
            'nick_name' => 'よっしー',
            'last_name' => '吉川',
            'first_name' => '学',
            'last_name_kana' => 'ヨシカワ',
            'first_name_kana' => 'マナブ',
            'pref' => '大阪府',
            'city' => '大阪市都島区片町1丁目',
            'town' => '7-7-302',
            'gender_id' => 1,
            'birthdate' => '1994-01-09',
        ]);
    }
}
