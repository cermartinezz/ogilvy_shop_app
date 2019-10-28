<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Muebles',
            'slug' => 'muebles'
        ]);

        DB::table('categories')->insert([
            'name' => 'Electrodomesticos',
            'slug' => 'electrodomesticos'
        ]);

        DB::table('categories')->insert([
            'name' => 'Tecnologia',
            'slug' => 'tecnologia'
        ]);
    }
}
