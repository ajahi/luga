<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'This account is for Admin',
        ]);

        $dreamsys = User::create([
            'name' => env('EMAIL'),
            'email' =>env('EMAIL'),
            'password'=> bcrypt(env('PASSWORD')),
        ]);

        $super_role = Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super admin',
            'description' => 'This account is for Super user',
        ]);
        $ajahi = User::create([
            'name' => 'ajahi',
            'email' => 'himaliamit1@gmail.com',
            'password' => bcrypt('passwword')
        ]);

        $role_user = [

            [
                'user_id' => $dreamsys->id,
                'role_id' => $super_role->id
            ],
            [
                'user_id' => $ajahi->id,
                'role_id' => $super_role->id
            ]
        ];
        DB::table('role_user')->insert($role_user);
    }

}
