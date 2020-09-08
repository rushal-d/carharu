<?php

use Illuminate\Database\Seeder;

class PostCategoriesPivotTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_categories_pivot')->delete();
        
        \DB::table('post_categories_pivot')->insert(array (
            0 => 
            array (
                'id' => 1,
                'post_id' => 3,
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'post_id' => 4,
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'post_id' => 5,
                'category_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'post_id' => 6,
                'category_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}