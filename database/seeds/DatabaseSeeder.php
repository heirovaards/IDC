<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding function begin
        // seeding executed in the sam sequence as written here
        $this->call(interestseeder::class);
        $this->call('PermissionsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('ConnectRelationshipsSeeder');
        $this->call('UserSeeder');
        $this->call(UserRoleTableSeeder::class);
    }
}
