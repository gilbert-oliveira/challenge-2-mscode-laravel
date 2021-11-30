<?php

namespace Database\Seeders;

use DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class FirstUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'cpf' => '31140502719',
            'email' => 'admin@admin.com',
            'master' => true,
            'active' => true,
            'password' => password_hash('12345678', PASSWORD_DEFAULT), // password
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
