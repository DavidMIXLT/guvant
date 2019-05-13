<?php

use Illuminate\Database\Seeder;
use AlaCartaYa\Role;
use AlaCartaYa\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //administrador, camarero, cocinero, cliente.

        $role_admin = Role::where('name', 'admin')->first();
        $role_waiter = Role::where('name', 'waiter')->first();
        $role_chef = Role::where('name', 'chef')->first();
        $role_customer = Role::where('name', 'customer')->first();

        $user = new User();
        $user->name='Admin';
        $user->email='admin@lacartaya.com';
        $user->password=bcrypt('admin');
        $user->save();
        $user->roles()->attach($role_admin);

        DB::table('orderStatus')->insert([
            'globalStatus' => 'Clean',

        ]);
    }
}
