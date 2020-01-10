<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Стандартная ононимная роль
        DB::table('roles')->insert
        ([
            [
                'name'=>'Anon',
            ]
         ]);
        //админская роль
        DB::table('roles')->insert
        (
            [
                'name'=>'Admin',
                'sign'=>'##admin##',
            ]
        );
        //стандартная роль юзера
        DB::table('roles')->insert
        ([

            [
                'name'=>'User',
            ]
        ]);
        //Роль глобол мода
        DB::table('roles')->insert
        ([
            [
                'name'=>'Global_mod',
                'sign'=>'##global_mod##',
            ],
        ]);
        //мод раздела
        DB::table('roles')->insert
        ([
            [
                'name'=>'Mod',
                'sign'=>'##Mod_b##',
                'board_prefix'=>'b'
            ]
        ]);
    }
}
