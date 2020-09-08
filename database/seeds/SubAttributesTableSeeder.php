<?php

use Illuminate\Database\Seeder;

class SubAttributesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sub_attributes')->delete();
        
        \DB::table('sub_attributes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'attribute_id' => 1,
                'name' => 'Additional Interior Features',
                'created_at' => '2020-03-20 08:22:43',
                'updated_at' => '2020-03-20 08:22:43',
            ),
            1 => 
            array (
                'id' => 2,
                'attribute_id' => 1,
                'name' => 'Leather Seats',
                'created_at' => '2020-03-20 08:22:43',
                'updated_at' => '2020-03-20 08:22:43',
            ),
            2 => 
            array (
                'id' => 3,
                'attribute_id' => 1,
                'name' => 'Dual Tone Dashboard',
                'created_at' => '2020-03-20 08:22:43',
                'updated_at' => '2020-03-20 08:22:43',
            ),
            3 => 
            array (
                'id' => 4,
                'attribute_id' => 1,
                'name' => 'Ventilated Seats',
                'created_at' => '2020-03-20 08:22:43',
                'updated_at' => '2020-03-20 08:22:43',
            ),
            4 => 
            array (
                'id' => 5,
                'attribute_id' => 1,
                'name' => 'Fabric Upholstery',
                'created_at' => '2020-03-20 08:22:43',
                'updated_at' => '2020-03-20 08:22:43',
            ),
            5 => 
            array (
                'id' => 6,
                'attribute_id' => 1,
                'name' => 'Rear Seat Headrest',
                'created_at' => '2020-03-20 08:22:43',
                'updated_at' => '2020-03-20 08:22:43',
            ),
            6 => 
            array (
                'id' => 7,
                'attribute_id' => 2,
                'name' => 'Trunk Opener',
                'created_at' => '2020-03-20 08:44:40',
                'updated_at' => '2020-03-20 08:44:40',
            ),
            7 => 
            array (
                'id' => 8,
                'attribute_id' => 2,
                'name' => 'Outside Rear View Mirror',
                'created_at' => '2020-03-20 08:44:40',
                'updated_at' => '2020-03-20 08:44:40',
            ),
            8 => 
            array (
                'id' => 9,
                'attribute_id' => 2,
                'name' => 'Xenon Headlights',
                'created_at' => '2020-03-20 08:44:40',
                'updated_at' => '2020-03-20 08:44:40',
            ),
            9 => 
            array (
                'id' => 10,
                'attribute_id' => 2,
                'name' => 'Rear Spoiler',
                'created_at' => '2020-03-20 08:44:41',
                'updated_at' => '2020-03-20 08:44:41',
            ),
            10 => 
            array (
                'id' => 11,
                'attribute_id' => 2,
                'name' => 'Roof Rails',
                'created_at' => '2020-03-20 08:44:41',
                'updated_at' => '2020-03-20 08:44:41',
            ),
            11 => 
            array (
                'id' => 12,
                'attribute_id' => 2,
                'name' => 'Alloy Wheels',
                'created_at' => '2020-03-20 08:44:41',
                'updated_at' => '2020-03-20 08:44:41',
            ),
            12 => 
            array (
                'id' => 13,
                'attribute_id' => 2,
                'name' => 'Turn indicators on ORVM',
                'created_at' => '2020-03-20 08:44:41',
                'updated_at' => '2020-03-20 08:44:41',
            ),
            13 => 
            array (
                'id' => 14,
                'attribute_id' => 2,
                'name' => 'Trunk Light',
                'created_at' => '2020-03-20 08:44:41',
                'updated_at' => '2020-03-20 08:44:41',
            ),
            14 => 
            array (
                'id' => 15,
                'attribute_id' => 2,
                'name' => 'Antenna',
                'created_at' => '2020-03-20 08:44:41',
                'updated_at' => '2020-03-20 08:44:41',
            ),
        ));
        
        
    }
}