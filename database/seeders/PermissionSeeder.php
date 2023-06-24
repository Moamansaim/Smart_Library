<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as ModelsPermission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*********** Category **************/
        ModelsPermission::create(['name' => 'Show-category', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Create-category', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Edit-category', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Delete-category', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Show-trash-category', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Restore-category', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'ForceDelete-category', 'guard_name' => 'admin']);

        /*********** Writer **************/
        ModelsPermission::create(['name' => 'Show-writer', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Create-writer', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Edit-writer', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Delete-writer', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Show-trash-writer', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Restore-writer', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'ForceDelete-writer', 'guard_name' => 'admin']);

        /*********** Home Publish **************/
        ModelsPermission::create(['name' => 'Show-homePublish', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Create-homePublish', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Edit-homePublish', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Delete-homePublish', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Show-trash-homePublish', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Restore-homePublish', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'ForceDelete-homePublish', 'guard_name' => 'admin']);

        /*********** Book **************/
        ModelsPermission::create(['name' => 'Show-book', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Create-book', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Edit-book', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Delete-book', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Show-trash-book', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Restore-book', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'ForceDelete-book', 'guard_name' => 'admin']);

        /*********** Admin **************/
        ModelsPermission::create(['name' => 'Show-admin', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Create-admin', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Edit-admin', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Delete-admin', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Show-trash-admin', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Restore-admin', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'ForceDelete-admin', 'guard_name' => 'admin']);

        /*********** User **************/
        ModelsPermission::create(['name' => 'Show-user', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Create-user', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Edit-user', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Delete-user', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Show-trash-user', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Restore-user', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'ForceDelete-user', 'guard_name' => 'admin']);

        /*********** Role **************/
        ModelsPermission::create(['name' => 'Show-role', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Create-role', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Edit-role', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Delete-role', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Show-trash-role', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Restore-role', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'ForceDelete-role', 'guard_name' => 'admin']);

        /*********** Role **************/
        ModelsPermission::create(['name' => 'Show-permissions', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Create-permissions', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Edit-permissions', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Delete-permissions', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Show-trash-permissions', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'Restore-permissions', 'guard_name' => 'admin']);
        ModelsPermission::create(['name' => 'ForceDelete-permissions', 'guard_name' => 'admin']);
    }
}
