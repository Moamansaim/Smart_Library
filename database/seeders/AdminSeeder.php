<?php

namespace Database\Seeders;

use App\Models\admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([

            "name" => 'moaman',
            "email" => 'moaman@gmail.com',
            "password" => Hash::make(147258369),
            'image' => ''

        ]);
        
    }
}
