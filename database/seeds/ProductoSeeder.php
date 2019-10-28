<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'category_id' => 3,
            'status' => true,
            'created_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'name' => 'Computadora Laptop',
            'slug' => 'computadora-reclinable',
            'category_id' => 3,
            'status' => false,
            'created_at' => Carbon::now()
        ]);

        DB::table('products')->insert([
            'name' => 'Lavadora',
            'slug' => 'lavadora',
            'category_id' => 3,
            'status' => false,
            'created_at' => Carbon::now()
        ]);
    }
}
