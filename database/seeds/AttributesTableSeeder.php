<?php

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('attributes')->delete();
        
        \DB::table('attributes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Interior',
                'created_at' => '2020-03-20 04:53:34',
                'updated_at' => '2020-03-20 04:53:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Exterior',
                'created_at' => '2020-03-20 08:43:43',
                'updated_at' => '2020-03-20 08:43:43',
            ),
        ));
        
        
    }
}