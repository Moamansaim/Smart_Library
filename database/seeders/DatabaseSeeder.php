<?php

namespace Database\Seeders;

use App\Models\admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
      /* admin::create([
            'name' => 'moaman',
            'email' => 'moaman@gmail.com',
            'password' => Hash::make(147258369),
            'image' => ''
        ]); */

        Permission::create(['name' => 'ShowDetails-book', 'guard_name' => 'admin']);

    }
}
