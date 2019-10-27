<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Sillon',
            'slug' => 'sillon',
            'category_id' => 1,
            'status' => true,
            'created_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'name' => 'Sillon Reclinable',
            'slug' => 'sillon-reclinable',
            'category_id' => 1,
            'status' => true,
            'created_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'name' => 'Celular',
            'slug' => 'celular',
            'category_id' => 2,
            'status' => true,
            'created_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'name' => 'Computadora Laptop',
            'slug' => 'computadora-reclinable',
            'category_id' => 2,
            'status' => false,
            'created_at' => Carbon::now()
        ]);
    }
}
