<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'General',
                'slug' => 'general',
                'description' => '<p>This is a general category.</p>',
                'image' => 'qtmjwue5sf941.jpg',
                'order' => 1,
                'created_at' => '2020-01-15 07:09:50',
                'updated_at' => '2020-01-15 07:09:50',
                'parent_id' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Home Page',
                'slug' => 'home-page',
                'description' => '<p>This is for home page.</p>',
                'image' => 'qtmjwue5sf941.jpg',
                'order' => 2,
                'created_at' => '2020-01-30 06:01:29',
                'updated_at' => '2020-01-30 06:01:29',
                'parent_id' => 1,
            ),
        ));
        
        
    }
}