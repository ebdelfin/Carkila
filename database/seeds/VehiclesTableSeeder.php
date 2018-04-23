<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            'make' => 'Toyota',
            'model' => 'Hiace Grandia',
            'year' => '2010',
            'type' => 'Van',
            'color' => 'White',
            'seating_capacity' => '19',
            'engine_number' => 'FNCEFW40234HF',
            'chassis_number' => 'BNSADJGM4353N',
            'plate_number' => 'ABC-213',
            'rental_rate' => '2500',
            'notes' => 'Gas included',
            'user_id' => User::all()->random()->id,
        ]);

        DB::table('vehicles')->insert([
            'make' => 'Honda',
            'model' => 'Jazz',
            'year' => '2008',
            'type' => 'Sedan',
            'color' => 'Yellow',
            'seating_capacity' => '5',
            'engine_number' => 'BNUJAJ436TBHS',
            'chassis_number' => 'LBJIFHDH43N32',
            'plate_number' => 'GRE-435',
            'rental_rate' => '1000',
            'notes' => 'Gas not included',
            'user_id' => User::all()->random()->id,
        ]);

        DB::table('vehicles')->insert([
            'make' => 'Mitsubishi   ',
            'model' => 'L300',
            'year' => '2006',
            'type' => 'Van',
            'color' => 'White',
            'seating_capacity' => '20',
            'engine_number' => 'KCN8N48436TBHS',
            'chassis_number' => 'GDHXUDBEUEOSNV',
            'plate_number' => 'BRH-325',
            'rental_rate' => '1500',
            'notes' => 'Lorem ipsum dolor sit amet qui eu quidam mentitum sonet errem affert ea qui.',
            'user_id' => User::all()->random()->id,
        ]);

        DB::table('vehicles')->insert([
            'make' => 'Toyota',
            'model' => 'Vios',
            'year' => '2016',
            'type' => 'Sedan',
            'color' => 'Black',
            'seating_capacity' => '6',
            'engine_number' => 'NGGJTDET754Y3H',
            'chassis_number' => 'WFNKGHT73O4NDY',
            'plate_number' => 'DRW-634',
            'rental_rate' => '3450',
            'notes' => 'Lorem ipsum dolor sit amet qui eu quidam mentitum sonet errem affert ea qui augue aeterno diceret ex cum Te scripta oporteat me. Eos te quando fuisset',
            'user_id' => User::all()->random()->id,
        ]);

          DB::table('vehicles')->insert([
              'make' => 'Mitsubishi',
              'model' => 'Montero Sport',
              'year' => '2018',
              'type' => 'SUV',
              'color' => 'Silver',
              'seating_capacity' => '9',
              'engine_number' => 'BGOBMDU482BF0S',
              'chassis_number' => 'VID58ND492GOSF',
              'plate_number' => 'WPV-224',
              'rental_rate' => '5000',
              'notes' => 'Te scripta oporteat me. Eos te quando fuisset',
              'user_id' => User::all()->random()->id,
          ]);


          DB::table('vehicles')->insert([
              'make' => 'Honda',
              'model' => 'CR-V',
              'year' => '2013',
              'type' => 'SUV',
              'color' => 'Red',
              'seating_capacity' => '8',
              'engine_number' => 'JII294BH125NG',
              'chassis_number' => 'BW325NHKPI75',
              'plate_number' => 'BEE-035',
              'rental_rate' => '4643',
              'notes' => 'Minimal Baggage only.',
              'user_id' => User::all()->random()->id,
          ]);

           DB::table('vehicles')->insert([
               'make' => 'Isuzu',
               'model' => 'i-Van',
               'year' => '2015',
               'type' => 'Van',
               'color' => 'White',
               'seating_capacity' => '16',
               'engine_number' => 'VORNRUVNE93752',
               'chassis_number' => 'GFWG85W4FNFRUG',
               'plate_number' => 'GVD-351',
               'rental_rate' => '3120',
               'notes' => 'Te scripta oporteat me. Eos te quando fuisset',
               'user_id' => User::all()->random()->id,
           ]);
    }
}
