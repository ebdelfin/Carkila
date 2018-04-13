<?php

use App\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Roles
         *
         */
        if (Role::where('slug', '=', 'admin')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ]);
        }


        if (Role::where('slug', '=', 'vehicle.owner')->first() === null) {
            $vehicleOwnerRole = Role::create([
                'name'        => 'Vehicle Owner',
                'slug'        => 'vehicle.owner',
                'description' => 'Vehicle owner role',
                'level'       => 1,
            ]);
        }

        if (Role::where('slug', '=', 'Renter')->first() === null) {
            $renterRole = Role::create([
                'name'        => 'Renter',
                'slug'        => 'Renter',
                'description' => 'Renter role',
                'level'       => 1,
            ]);
        }

    }
}
