<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nickname' => 'Chlorek',
            'email' => 'chlorek@gmail.com',
            'password'=> md5('password'),
        ]);
        
        User::create([
            'nickname' => 'Atomek',
            'email' => 'atomek@gmail.com',
            'password'=> md5('passworda'),
        ]);
        
        User::create([
            'nickname' => 'Admin',
            'email' => 'adminski@gmail.com',
            'password'=> md5('admin'),
            'usertype'=> 'Admin'
        ]);
    }
}
