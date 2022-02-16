<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class studentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('student')->insert([
            'name' => Str::random(10),
            'phone' => Str::random(10).'@gmail.com',
            'address' => Hash::make('password'),
        ]);
    }
}
