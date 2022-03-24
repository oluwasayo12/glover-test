<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        try{
            $super_admin = User::create([
                'name' => 'Glover Super Admin',
                'email' => 'super_admin@glover.com',
                'password' => 'gloversuperadmin'
            ]);
            $super_role_details = Role::where('name', '=', 'super_admin')->firstOrFail();
            $super_admin->assignRole($super_role_details);


            $create_request_admin = User::create([
                'name' => 'Glover Create Request Admin',
                'email' => 'create_request@glover.com',
                'password' => 'glovercreateadmin'
            ]);
            $create_role_details = Role::where('name', '=', 'create_request_admin')->firstOrFail();
            $create_request_admin->assignRole($create_role_details);


            $update_request_admin = User::create([
                'name' => 'Glover Approve Or Decline Admin',
                'email' => 'update_request_status_admin@glover.com',
                'password' => 'gloverupdaterequestadmin'
            ]);
            $update_request_role_details = Role::where('name', '=', 'update_request_admin')->firstOrFail();
            $update_request_admin->assignRole($update_request_role_details);


            DB::commit();

        }catch(Exception $e)
        {
            DB::rollBack();
        }        
    }
}
