<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() == 'production') {
            exit("You shouldn't run seeds on production databases");
        }

        DB::table('roles')->truncate();

        Role::create([
            'id' => 3,
            'name' => 'Root',
            'description' => 'God user. Access to everything.'
        ]);

        Role::create([
            'id' => 2,
            'name' => 'Administrator',
            'description' => 'Administrator user.  Many privileges.'
        ]);

        Role::create([
            'id' => 1,
            'name' => 'Guest',
            'description' => 'Basic user.'
        ]);

    }
}
