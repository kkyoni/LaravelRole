<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        User::create([
            'user_name' => 'Super Admin',
            'first_name' => 'Super Admin',
            'last_name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('smn@1234'),
            'user_type' => 'superadmin',
            'role_id' => '1',
        	'status' => 'active',
        ]);
        User::create([
            'user_name' => 'Admin',
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('smn@1234'),
            'user_type' => 'admin',
            'role_id' => '2',
            'status' => 'active',
        ]);
        User::create([
            'user_name' => 'Cms',
            'first_name' => 'Cms',
            'last_name' => 'Cms',
            'email' => 'cms@gmail.com',
            'password' => bcrypt('smn@1234'),
            'user_type' => 'cms',
            'role_id' => '3',
            'status' => 'active',
        ]);
    }
}