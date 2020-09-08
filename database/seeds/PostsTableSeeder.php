<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'About Us',
                'description' => '<p>CarHaru aims at reducing the hassle of asking around before purchasing your dream car. It provides you with all the required information and specifications that might be fruitful before you cash in.</p>',
                'excerpt' => '<p>ok</p>',
                'published_date' => '2020-01-15 00:00:00',
                'published_date_np' => '2076-10-1',
                'featured_image' => 'rf610msqoe941.png',
                'sort_order' => 1,
                'slug' => 'about-us',
                'created_at' => '2020-01-15 08:41:49',
                'updated_at' => '2020-01-17 05:00:31',
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'Contact Us',
                'description' => '<p>Address: Kathmandu Nepal<br />
Contact no: +977-9851108888<br />
Website: <a href="https://www.tnia.com.au">https://www.tnia.com.au</a>.np<br />
Email: <a href="mailto:order@bhokmandu.com">order@bhokmandu.com</a>.np</p>',
                'excerpt' => '<p>For contact page.</p>',
                'published_date' => '2020-01-15 00:00:00',
                'published_date_np' => '2076-10-1',
                'featured_image' => 'rose-blue-flower-rose-blooms-67636.jpeg',
                'sort_order' => 2,
                'slug' => 'contact-us',
                'created_at' => '2020-01-15 09:23:07',
                'updated_at' => '2020-01-16 05:31:59',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Haha',
                'description' => '<p>okokokok</p>',
                'excerpt' => '<p>asdasdad</p>',
                'published_date' => '2020-01-16 00:00:00',
                'published_date_np' => '2076-10-2',
                'featured_image' => 'qtmjwue5sf941.jpg',
                'sort_order' => 4,
                'slug' => 'haha',
                'created_at' => '2020-01-16 05:14:35',
                'updated_at' => '2020-01-16 05:14:35',
            ),
            3 => 
            array (
                'id' => 6,
                'name' => 'Banner',
                'description' => '<h3>Search Car Haru Here</h3>',
                'excerpt' => NULL,
                'published_date' => '2020-01-30 00:00:00',
                'published_date_np' => '2076-10-16',
                'featured_image' => 'slider.jpg',
                'sort_order' => 4,
                'slug' => 'banner',
                'created_at' => '2020-01-30 08:34:50',
                'updated_at' => '2020-01-30 08:34:50',
            ),
        ));
        
        
    }
}