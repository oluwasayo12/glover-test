<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateRoleandPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $view_permission = Permission::create(['name'=>'view-request']);
        $make_request_permission = Permission::create(['name'=>'make-request']);
        $process_request_permission = Permission::create(['name' => 'process-request']);

        $super_admin_role = Role::create(["name"=>"super_admin"]);
        $super_admin_role->givePermissionTo('view-request');

        $create_request_admin_role = Role::create(["name"=>"create_request_admin"]);
        $create_request_admin_role->syncPermissions([$view_permission->id, $make_request_permission->id ]);

        $update_request_admin_role = Role::create(["name"=>"update_request_admin"]);
        $update_request_admin_role->syncPermissions([$view_permission->id, $process_request_permission->id ]);
    }
}
