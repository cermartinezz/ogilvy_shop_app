<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'cesar',
            'last_name' => 'martinez',
            'email' => 'cesarmartinez9311@gmail.com',
            'role_id' => 1,
            'password' => bcrypt('12345678'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('users')->insert([
            'first_name' => 'Juan',
            'last_name' => 'Perez',
            'email' => 'cliente@gmail.com',
            'role_id' => 2,
            'password' => bcrypt('12345678'),
            'email_verified_at' => \Carbon\Carbon::now(),
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
