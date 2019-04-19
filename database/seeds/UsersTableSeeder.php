<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name'=> 'Cris',
            'email'=> 'cris-tg11@hotmail.com',
            'password'=>bcrypt('12345678'),
            'admin'=>true
        ]);
    }
}
