<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $newUser = User::create([
            'name' => 'Admin',
            'email' => 'Admin@lol.com',
            'password' => Hash::make('123456789'),
        ]);
        $role = Role::where('name', 'Admin')->get()->first();
        $newUser->roles()->save($role);

        $newUser = User::create([
            'name' => 'Anon',
            'email' => 'Anon@lol.com',
            'password' => Hash::make('123456789'),
        ]);
        $role = Role::where('name', 'Anon')->get()->first();
        $newUser->roles()->save($role);

    }
}
