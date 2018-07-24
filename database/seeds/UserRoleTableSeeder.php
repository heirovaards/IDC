<?php

use App\User;
use jeremykenedy\LaravelRoles\Models\User_role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User_role::create([
            'role_id'=> '1',
            'user_id'=>'1',
        ]);

        User_role::create([
            'role_id'=> '2',
            'user_id'=>'2',
        ]);

        User_role::create([
            'role_id'=> '4',
            'user_id'=>'3',
        ]);
    }
}
