<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Rosyid Grobogan',
            'username' => 'rosyid',
            'password' => bcrypt('password'),
            'email' => 'rosyid@abc.com'
        ]);
    }
}
