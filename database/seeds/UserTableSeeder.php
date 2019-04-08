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
        	'name'=>'JankieChan',
        	'email'=>'jankie@Chan.com',
        	'password' =>bcrypt('3015')
        ]);
    }
}
