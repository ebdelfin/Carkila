<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Get Available Permissions.
         */
        $permissions = Permission::all();

        $postPermissions = $permissions->whereIn('slug', ['create.post', 'edit.post', 'delete.post']);


     
        /**
        * Get Available Roles.
        */
        $roleAdmin = Role::where('slug', '=', 'admin')->first();
        $roleVehicleOwner = Role::where('slug', '=', 'vehicle.owner')->first();
        $roleRenter= Role::where('slug', '=', 'renter')->first();





        /**
         * Attach Permissions to Roles.
         */

        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
        }

       

        
        foreach ($postPermissions as $permission) {
            $roleVehicleOwner->attachPermission($permission);
            $roleRenter->attachPermission($permission);
        }
     
        


    }
}
