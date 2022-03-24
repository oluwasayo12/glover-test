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
        $view_permission = Permission::create(['guard_name'=>'api','name'=>'view-request']);
        $make_request_permission = Permission::create(['guard_name'=>'api','name'=>'make-request']);
        $process_request_permission = Permission::create(['guard_name'=>'api','name' => 'process-request']);

        $super_admin_role = Role::create(["guard_name"=>"api","name"=>"super_admin"]);
        $super_admin_role->givePermissionTo('view-request');

        $create_request_admin_role = Role::create(["guard_name"=>"api","name"=>"create_request_admin"]);
        $create_request_admin_role->syncPermissions([$view_permission->id, $make_request_permission->id ]);

        $update_request_admin_role = Role::create(["guard_name"=>"api","name"=>"update_request_admin"]);
        $update_request_admin_role->syncPermissions([$view_permission->id, $process_request_permission->id ]);
    }
}
