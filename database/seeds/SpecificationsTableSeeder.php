<?php

use Illuminate\Database\Seeder;

class SpecificationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('specifications')->delete();
        
        \DB::table('specifications')->insert(array (
            0 => 
            array (
                'id' => 1,
                'specification' => 'Suspension',
                'created_at' => '2019-11-06 05:23:21',
                'updated_at' => '2019-11-06 05:23:21',
            ),
            1 => 
            array (
                'id' => 2,
                'specification' => 'Dimension',
                'created_at' => '2019-11-06 05:36:37',
                'updated_at' => '2019-11-06 05:36:37',
            ),
            2 => 
            array (
                'id' => 3,
                'specification' => 'Engine & Transmission',
                'created_at' => '2019-11-07 09:59:10',
                'updated_at' => '2019-11-07 09:59:10',
            ),
            3 => 
            array (
                'id' => 4,
                'specification' => 'Capacity',
                'created_at' => '2019-11-08 04:27:49',
                'updated_at' => '2019-11-08 04:27:49',
            ),
            4 => 
            array (
                'id' => 6,
                'specification' => 'Colors',
                'created_at' => '2019-11-11 06:11:35',
                'updated_at' => '2019-11-11 06:11:35',
            ),
        ));
        
        
    }
}