<?php

use Illuminate\Database\Seeder;
use App\User;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Models\Permission;



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
              'name'=> 'satriya wardhana',
              'email'=>'satriyawardhana@gmail.com',
              'password'=>bcrypt('05021995'),
              'username'=>'satriya',
              'role'=>'admin',
              'interest'=>'1',
              'ocupation'=>'web master',
              'address'=>'jogjakarta'
        ]);

       User::create([
              'name'=> 'test user',
              'email'=>'test@test.com',
              'password'=>bcrypt('123456'),
              'role'=>'user',
              'interest'=>'1',
              'username'=>'testuser',
              'ocupation'=>'user tester',
              'address'=>'jogjakarta'
        ]);

       User::create([
              'name'=> 'test org',
              'email'=>'test@test.org',
              'password'=>bcrypt('123456'),
              'role'=>'organization',
              'interest'=>'1',
              'username'=>'testorg',
              'ocupation'=>'event organizer',
              'address'=>'jogjakarta'
        ]);
    }
}
