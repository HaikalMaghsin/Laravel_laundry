<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class akun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'zaki',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 1,
                'outlet_id' => 1
            ],
            [
                'name' => 'bima',
                'email' => 'kasir@gmail.com',
                'password' => bcrypt('password'),
                'role' => 2,
                'outlet_id' => 1
            ],
            [
                'name' => 'haikal',
                'email' => 'owner@gmail.com',
                'password' => bcrypt('password'),
                'role' => 3,
                'outlet_id' => 1
            ],
        ];
        foreach($data as $key => $d){
            User::create($d);
        };
    }
}
