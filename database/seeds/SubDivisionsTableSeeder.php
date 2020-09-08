<?php

use Illuminate\Database\Seeder;

class SubDivisionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sub_divisions')->delete();
        
        \DB::table('sub_divisions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'division_id' => 1,
                'name' => 'SUV/MUV',
                'description' => NULL,
                'slug' => 'suv-muv',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'created_at' => '2020-02-20 09:31:30',
                'updated_at' => '2020-02-20 09:31:30',
            ),
            1 => 
            array (
                'id' => 2,
                'division_id' => 2,
                'name' => 'Automatic',
                'description' => NULL,
                'slug' => 'automatic',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'created_at' => '2020-02-20 09:35:24',
                'updated_at' => '2020-02-20 09:35:24',
            ),
            2 => 
            array (
                'id' => 4,
                'division_id' => 1,
                'name' => 'Sedan',
                'description' => NULL,
                'slug' => 'sedan',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'created_at' => '2020-02-20 10:10:08',
                'updated_at' => '2020-02-20 10:10:08',
            ),
            3 => 
            array (
                'id' => 5,
                'division_id' => 2,
                'name' => 'Manual',
                'description' => NULL,
                'slug' => 'manual',
                'seo_title' => NULL,
                'seo_description' => NULL,
                'created_at' => '2020-03-20 09:00:50',
                'updated_at' => '2020-03-20 09:00:50',
            ),
        ));
        
        
    }
}