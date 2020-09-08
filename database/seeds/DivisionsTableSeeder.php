<?php

use Illuminate\Database\Seeder;

class DivisionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('divisions')->delete();
        
        \DB::table('divisions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Body Type',
                'description' => '<p>This division is for body type.YEAH!!!!</p>',
                'slug' => 'body-type',
                'created_at' => '2020-02-20 08:17:44',
                'updated_at' => '2020-02-20 08:42:46',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Transmission',
                'description' => '<p>This is for the transmission section.YEAH!!</p>',
                'slug' => 'transmission',
                'created_at' => '2020-02-20 09:32:12',
                'updated_at' => '2020-02-20 09:32:12',
            ),
        ));
        
        
    }
}