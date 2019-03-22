<?php

use Illuminate\Database\Seeder;
use AlaCartaYa\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //administrador, camarero, cocinero, cliente.
        $role = new Role();
        $role->name='admin';
        $role->description="Administrator";
        $role->save();

        $role=new Role();
        $role->name='waiter';
        $role->description="Waiter/Camarero";
        $role->save();

        $role=new Role();
        $role->name='chef';
        $role->description="Chef/Cocinero";
        $role->save();

        $role=new Role();
        $role->name='customer';
        $role->description="Customer/Cliente";
        $role->save();

    }
}
