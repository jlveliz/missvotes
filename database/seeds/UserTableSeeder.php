<?php

use Illuminate\Database\Seeder;
use MissVote\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('jlvb5jorgeluis');
        $data = [
        	'email'=>'jorgeconsalvacion@gmail.com',
        	'password'=>$password,
        	'name'=> 'Administrador',
        	'address'=> "Por ahí"
        ];

        User::create($data);
    }
}
