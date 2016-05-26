<?php

/* I created this dependencies */
use App\User;
use Illuminate\Support\Facades\Hash;

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
        User::create([
        	'name' => 'Reymark Torres',
        	'email' => 'reymark.torres08@gmail.com',
        	'password' => Hash::make('pass')
        ]);

        User::create([
        	'name' => 'Lady Morganne',
        	'email' => 'ladymorgannelumbre05@gmail.com',
        	'password' => Hash::make('pass')
        ]);
    }
}
