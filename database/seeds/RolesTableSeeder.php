<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'display_name' => 'Admin',
                'description' => NULL,
                'created_at' => '2019-01-02 05:11:40',
                'updated_at' => '2019-01-02 05:11:40',
            ),
        ));
        
        
    }
}