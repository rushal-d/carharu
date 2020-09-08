<?php

use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('features')->delete();
        
        \DB::table('features')->insert(array (
            0 => 
            array (
                'id' => 1,
                'specs_id' => 1,
                'feature' => 'Suspension Front',
                'created_at' => '2019-11-06 05:54:11',
                'updated_at' => '2019-11-06 05:54:11',
            ),
            1 => 
            array (
                'id' => 2,
                'specs_id' => 2,
            'feature' => 'Length (mm)',
                'created_at' => '2019-11-06 06:01:30',
                'updated_at' => '2019-11-06 06:01:30',
            ),
            2 => 
            array (
                'id' => 3,
                'specs_id' => 1,
                'feature' => 'Suspension Rear',
                'created_at' => '2019-11-06 06:01:59',
                'updated_at' => '2019-11-06 06:01:59',
            ),
            3 => 
            array (
                'id' => 4,
                'specs_id' => 1,
                'feature' => 'Front Break Type',
                'created_at' => '2019-11-06 10:39:47',
                'updated_at' => '2019-11-06 10:39:47',
            ),
            4 => 
            array (
                'id' => 5,
                'specs_id' => 1,
                'feature' => 'Rear Break Type',
                'created_at' => '2019-11-06 10:40:05',
                'updated_at' => '2019-11-06 10:40:05',
            ),
            5 => 
            array (
                'id' => 6,
                'specs_id' => 3,
                'feature' => 'Engine Type',
                'created_at' => '2019-11-07 10:01:28',
                'updated_at' => '2019-11-07 10:01:28',
            ),
            6 => 
            array (
                'id' => 7,
                'specs_id' => 3,
                'feature' => 'Fuel Type',
                'created_at' => '2019-11-07 10:01:36',
                'updated_at' => '2019-11-07 10:01:36',
            ),
            7 => 
            array (
                'id' => 8,
                'specs_id' => 4,
            'feature' => 'Doors (Doors)',
                'created_at' => '2019-11-08 04:29:22',
                'updated_at' => '2019-11-08 04:29:22',
            ),
            8 => 
            array (
                'id' => 9,
                'specs_id' => 4,
            'feature' => 'Seating Capacity (Person)',
                'created_at' => '2019-11-08 04:29:30',
                'updated_at' => '2019-11-08 04:29:30',
            ),
            9 => 
            array (
                'id' => 11,
                'specs_id' => 4,
            'feature' => 'Bootspace (litres)',
                'created_at' => '2019-11-08 04:35:31',
                'updated_at' => '2019-11-08 04:35:31',
            ),
            10 => 
            array (
                'id' => 12,
                'specs_id' => 2,
            'feature' => 'width(feet)',
                'created_at' => '2019-11-11 04:28:11',
                'updated_at' => '2019-11-11 04:28:11',
            ),
            11 => 
            array (
                'id' => 13,
                'specs_id' => 2,
            'feature' => 'height(feet)',
                'created_at' => '2019-11-11 04:28:17',
                'updated_at' => '2019-11-11 04:28:17',
            ),
            12 => 
            array (
                'id' => 14,
                'specs_id' => 2,
            'feature' => 'Wheel Base(mm)',
                'created_at' => '2019-11-11 04:29:22',
                'updated_at' => '2019-11-11 04:29:22',
            ),
            13 => 
            array (
                'id' => 15,
                'specs_id' => 3,
            'feature' => 'Max Power (bhp@rpm)',
                'created_at' => '2019-11-11 05:31:33',
                'updated_at' => '2019-11-11 05:31:33',
            ),
            14 => 
            array (
                'id' => 16,
                'specs_id' => 3,
            'feature' => 'Max Torque (Nm@rpm)',
                'created_at' => '2019-11-11 05:37:07',
                'updated_at' => '2019-11-11 05:37:07',
            ),
            15 => 
            array (
                'id' => 17,
                'specs_id' => 3,
            'feature' => 'Mileage (ARAI) (kmpl)',
                'created_at' => '2019-11-11 05:37:07',
                'updated_at' => '2019-11-11 05:37:07',
            ),
            16 => 
            array (
                'id' => 18,
                'specs_id' => 6,
                'feature' => 'Color',
                'created_at' => '2019-11-11 08:27:46',
                'updated_at' => '2019-11-11 08:27:46',
            ),
            17 => 
            array (
                'id' => 19,
                'specs_id' => 4,
            'feature' => 'Fuel Tank Capacity (litres)',
                'created_at' => '2019-11-13 04:47:14',
                'updated_at' => '2019-11-13 04:47:14',
            ),
        ));
        
        
    }
}