<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'BMP Infology',
                    'email' => 'bmp@bmpinfology.com',
                    'email_verified_at' => NULL,
                    'password' => '$2y$10$6O3rASyZ2cCHjatm.gf4buHUO7fXvyIpFCPxmlWvlmMNFA9ws4u3C',
                    'remember_token' => NULL,
                    'created_at' => '2019-01-02 06:03:20',
                    'updated_at' => '2019-01-02 10:39:51',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Shree',
                    'email' => 'shree@bmpinfology.com',
                    'email_verified_at' => NULL,
                    'password' => '$2y$10$/oYB4p96Db9oz0KHY79.VOgvr2kgtUkRkdC83..VAmPm3datl64sO',
                    'remember_token' => NULL,
                    'created_at' => '2019-01-02 06:03:55',
                    'updated_at' => '2019-01-02 06:03:55',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Lijesh',
                    'email' => 'lijesh@bmpinfology.com',
                    'email_verified_at' => NULL,
                    'password' => '$2y$10$wfXp7UZ20.XW6fmhNIjLtey6K6RsqGYQqB6DGCIEZJ4ot932JKef.',
                    'remember_token' => NULL,
                    'created_at' => '2019-01-02 06:03:55',
                    'updated_at' => '2019-01-02 06:03:55',
                ),
        ));


    }
}
