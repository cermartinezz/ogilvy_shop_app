<?php

use Illuminate\Database\Seeder;

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
    }
}
