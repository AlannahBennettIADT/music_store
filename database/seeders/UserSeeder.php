<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;


use App\Models\Role;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  
        $role_admin = Role::where('name', 'admin')->first();
        $role_user = Role::where('name', 'user')->first();

        $admin = new User();
        $admin->name = 'Alannah Bennett';
        $admin->email = 'alannah@olus.education';
        $admin->password = Hash::make('password'); 
        $admin->save();

        $admin->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Alannah Test';
        $user->email = 'alannahmb2004@gmail.com';
        $user->password = Hash::make('password'); 
        $user->save();

        $user->roles()->attach($role_user);


        $editor_user = new User();
        $editor_user->name = 'Alannah Editor';
        $editor_user->email = 'editor@gmail.com';
        $editor_user->password = Hash::make('password'); 
        $editor_user->save();

        $user->roles()->attach($editor_user);


    }
}
