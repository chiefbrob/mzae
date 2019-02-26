<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // modify this user
        User::create([

        	'name' => 'Timothy M',
        	'username' => 'timo', 
        	'email' => 'timo@lughayetu.net',
        	'role' => 'admin', 
        	'password' => '$2y$10$.DqIlvVteSZu6RiTxog6fuOrzJl5KtP6wwVKUhLUV2raNwpd7/5Wq',
        	'remember_token' => str_random(10)
        ]);
    }
}
