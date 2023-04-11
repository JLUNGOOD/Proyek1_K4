<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        
        DB::table('users')->insert([
            [
                'name' => 'Tono',
                'email' => 'tono1@gmail.com',
                'role' => '1',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2000-11-02',
                'password' => Hash::make('1234')
            ],
            // [
            //     'name' => 'Endah',
            //     'email' => 'endah1@gmail.com',
            //     'role' => '2',
            //     'jenis_kelamin' => 'P',
            //     'tanggal_lahir' => '2000-01-22',
            //     'password' => Hash::make('1234')
            // ]
        ]);
    }
}
