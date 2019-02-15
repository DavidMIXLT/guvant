<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            'name' => 'Coca Cola',
            'description' => str_random(10),
            'stock' => rand(1,15),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('products')->insert([
            'name' => 'Fanta de Naranja',
            'description' => str_random(10),
            'stock' => rand(1,15),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('products')->insert([
            'name' => 'Acuarios',
            'description' => str_random(10),
            'stock' => rand(1,15),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('products')->insert([
            'name' => 'Macarrones',
            'description' => str_random(10),
            'stock' => rand(1,15),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('products')->insert([
            'name' => 'Sal',
            'description' => str_random(10),
            'stock' => rand(1,15),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('products')->insert([
            'name' => 'Aceite',
            'description' => str_random(10),
            'stock' => rand(1,15),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('products')->insert([
            'name' => 'Azucar',
            'description' => str_random(10),
            'stock' => rand(1,15),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
    }
}
