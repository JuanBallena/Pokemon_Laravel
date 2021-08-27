<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrador',
        ]);

        Role::create([
            'name' => 'trainer',
            'display_name' => 'Entrenador Pokemon',
        ]);

        User::create([
            'name' => 'Pablo',
            'email' => 'jpbu2310@gmail.com',
            'password' => '123456',
            'role_id' => 1,
            'state' => 1,
        ]);
    }
}
