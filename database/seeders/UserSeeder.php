<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
            DB::transaction(function () {
                $super_admin = User::create([
                    'name' => 'Glover Super Admin',
                    'email' => 'super_admin@glover.com',
                    'password' => Hash::make('gloversuperadmin')
                ]);
                $super_role_details = Role::where('name', '=', 'super_admin')->firstOrFail();
                $super_admin->assignRole($super_role_details);


                $create_request_admin = User::create([
                    'name' => 'Glover Create Request Admin',
                    'email' => 'create_request@glover.com',
                    'password' =>  Hash::make('glovercreateadmin')
                ]);
                $create_role_details = Role::where('name', '=', 'create_request_admin')->firstOrFail();
                $create_request_admin->assignRole($create_role_details);


                $update_request_admin = User::create([
                    'name' => 'Glover Approve Or Decline Admin',
                    'email' => 'update_request_status_admin@glover.com',
                    'password' =>  Hash::make('gloverupdaterequestadmin')
                ]);
                $update_request_role_details = Role::where('name', '=', 'update_request_admin')->firstOrFail();
                $update_request_admin->assignRole($update_request_role_details);


                DB::commit();
            });

        }catch(Exception $e)
        {
            DB::rollBack();
        }        
    }
}
