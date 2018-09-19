<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name'=>'Admin',
            'password'=> bcrypt('admin'),
            'email'=> 'admin@example.com',
            'admin'=> 1,
            'avatar'=> 'avatars/avatar.jpg'
        ]);

        App\User::create([
            'name'=>'Princess Mnisi',
            'password'=> bcrypt('password'),
            'email'=> 'princess.mnisi@example.com',
            'avatar'=> 'avatars/avatar.jpg'
        ]);
    }
}
