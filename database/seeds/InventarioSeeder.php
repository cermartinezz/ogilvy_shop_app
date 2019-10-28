<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->insert([
            'code_bar' => Str::random(50),
            'brand' => Str::ucfirst('Xiaomi'),
            'model' => Str::lower('pocophone 2 64Gb'),
            'price' => 150,
            'discount' => 0,
            'percentage_discount' => 0,
            'available' => 1,
            'product_id' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('stocks')->insert([
            'code_bar' => Str::random(50),
            'brand' => Str::ucfirst('Xiaomi'),
            'model' => Str::lower('pocophone 2  64Gb'),
            'price' => 150,
            'discount' => 0,
            'percentage_discount' => 0,
            'available' => 1,
            'product_id' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('stocks')->insert([
            'code_bar' => Str::random(50),
            'brand' => Str::ucfirst('Xiaomi'),
            'model' => Str::lower('pocophone 2  128Gb'),
            'price' => 250,
            'discount' => 0,
            'percentage_discount' => 0,
            'available' => 1,
            'product_id' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('stocks')->insert([
            'code_bar' => Str::random(50),
            'brand' => Str::ucfirst('Huawei'),
            'model' => Str::lower('P30 lite'),
            'price' => 250,
            'discount' => 0,
            'percentage_discount' => 0,
            'available' => 1,
            'product_id' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('stocks')->insert([
            'code_bar' => Str::random(50),
            'brand' => Str::ucfirst('Huawei'),
            'model' => Str::lower('P30 lite'),
            'price' => 250,
            'discount' => 0,
            'percentage_discount' => 0,
            'available' => 1,
            'product_id' => 3,
            'created_at' => Carbon::now()
        ]);

        DB::table('stocks')->insert([
            'code_bar' => Str::random(50),
            'brand' => Str::ucfirst('Huawei'),
            'model' => Str::lower('P30 lite'),
            'price' => 250,
            'discount' => 0,
            'percentage_discount' => 0,
            'available' => 1,
            'product_id' => 3,
            'created_at' => Carbon::now()
        ]);
    }
}
