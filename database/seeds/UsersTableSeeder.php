<?php

use App\Models\Profile;
use App\Models\User;
use App\Models\Owner;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $profile = new Profile();
        $adminRole = Role::whereName('Admin')->first();
        $vehicleOwnerRole = Role::whereName('Vehicle Owner')->first();
        $renterRole = Role::whereName('Renter')->first();

        // Seed test admin
        $seededAdminEmail = 'admin@admin.com';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => $seededAdminEmail,
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_confirmation_ip_address' => $faker->ipv4,
                'admin_ip_address'               => $faker->ipv4,
            ]);

            $user->profile()->save($profile);
            $user->attachRole($adminRole);
            $user->save();
        }

        // Seed test user
        $user = User::where('email', '=', 'vehicleowner@user.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'gender'                      => 'Male',
                'city'                      => 'Makati City',
                'address'                      => 'someaddress',
                'mobile_number'                      => '09123456789',
                'birth_date'                      => '2018-04-14',
                'email'                          => 'vehicleowner@user.com',
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($vehicleOwnerRole);
            $user->save();

            Owner::create([
                'license_number'                           => '123456789',
                'license_expiry'                         => '2018-04-14',
                'user_id'                         => $user->id,
            ]);

        }
        $user = User::where('email', '=', 'vehicleowner2@user.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'gender'                      => 'Female',
                'city'                      => 'Mandaluyong City',
                'address'                      => 'owner2address',
                'mobile_number'                      => '09123456789',
                'birth_date'                      => '2018-04-14',
                'email'                          => 'vehicleowner2@user.com',
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($vehicleOwnerRole);
            $user->save();

            Owner::create([
                'license_number'                           => '321321',
                'license_expiry'                         => '2018-02-14',
                'user_id'                         => $user->id,
            ]);

        }





        // Seed test user
        $user = User::where('email', '=', 'renter@user.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'gender'                      => 'Female',
                'city'                      => 'Pasay City',
                'address'                      => 'renter1addresss',
                'mobile_number'                      => '09987654321',
                'birth_date'                      => '2018-04-14',
                'email'                          => 'renter@user.com',
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($renterRole);
            $user->save();
        }

        $user = User::where('email', '=', 'renter2@user.com')->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'gender'                      => 'Female',
                'city'                      => 'Paranaque City',
                'address'                      => 'renter2address',
                'mobile_number'                      => '09987654321',
                'birth_date'                      => '2018-04-14',
                'email'                          => 'renter2@user.com',
                'password'                       => Hash::make('password'),
                'token'                          => str_random(64),
                'activated'                      => true,
                'signup_ip_address'              => $faker->ipv4,
                'signup_confirmation_ip_address' => $faker->ipv4,
            ]);

            $user->profile()->save(new Profile());
            $user->attachRole($renterRole);
            $user->save();
        }

        // Seed test users
        // $user = factory(App\Models\Profile::class, 5)->create();
        // $users = User::All();
        // foreach ($users as $user) {
        //     if (!($user->isAdmin()) && !($user->isUnverified())) {
        //         $user->attachRole($userRole);
        //     }
        // }
    }
}
