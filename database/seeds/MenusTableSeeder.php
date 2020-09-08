<?php

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menus')->delete();
        
        \DB::table('menus')->insert(array (
            0 => 
            array (
                'id' => 8,
                'menu_name' => 'home',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Dashboard',
                'parent_id' => 0,
                'order' => 3,
                'icon' => 'fas fa-home',
                'created_at' => '2019-12-29 11:07:07',
                'updated_at' => '2020-02-20 08:05:10',
            ),
            1 => 
            array (
                'id' => 9,
                'menu_name' => 'role.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Roles',
                'parent_id' => 46,
                'order' => 3,
                'icon' => NULL,
                'created_at' => '2019-01-02 10:04:13',
                'updated_at' => '2019-01-02 10:32:33',
            ),
            2 => 
            array (
                'id' => 16,
                'menu_name' => 'permission.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Permission',
                'parent_id' => 46,
                'order' => 4,
                'icon' => NULL,
                'created_at' => '2019-01-02 10:04:25',
                'updated_at' => '2019-01-02 10:32:33',
            ),
            3 => 
            array (
                'id' => 25,
                'menu_name' => 'user.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Users',
                'parent_id' => 46,
                'order' => 2,
                'icon' => NULL,
                'created_at' => '2019-01-02 09:31:06',
                'updated_at' => '2019-01-02 10:32:16',
            ),
            4 => 
            array (
                'id' => 32,
                'menu_name' => 'assignrole.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Assign Permission',
                'parent_id' => 46,
                'order' => 5,
                'icon' => NULL,
                'created_at' => '2019-01-02 10:04:48',
                'updated_at' => '2019-01-02 10:32:33',
            ),
            5 => 
            array (
                'id' => 46,
                'menu_name' => '#usermanagement',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'User Management',
                'parent_id' => 0,
                'order' => 12,
                'icon' => 'fas fa-user-check',
                'created_at' => '2019-01-02 09:26:37',
                'updated_at' => '2020-02-20 08:06:27',
            ),
            6 => 
            array (
                'id' => 47,
                'menu_name' => 'menu-index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Menu Builder',
                'parent_id' => 46,
                'order' => 6,
                'icon' => NULL,
                'created_at' => '2019-01-02 10:06:43',
                'updated_at' => '2019-01-02 10:07:25',
            ),
            7 => 
            array (
                'id' => 53,
                'menu_name' => 'brand.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Brands',
                'parent_id' => 0,
                'order' => 4,
                'icon' => 'fas fa-car',
                'created_at' => '2019-10-24 08:44:25',
                'updated_at' => '2020-02-20 08:05:10',
            ),
            8 => 
            array (
                'id' => 62,
                'menu_name' => 'model.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Models',
                'parent_id' => 0,
                'order' => 5,
                'icon' => 'fas fa-car-side',
                'created_at' => '2019-10-24 09:05:24',
                'updated_at' => '2020-02-20 08:05:10',
            ),
            9 => 
            array (
                'id' => 73,
                'menu_name' => '#Settings',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Master Setup',
                'parent_id' => 0,
                'order' => 11,
                'icon' => 'fas fa-wheelchair',
                'created_at' => '2019-11-06 07:10:32',
                'updated_at' => '2020-02-20 08:06:27',
            ),
            10 => 
            array (
                'id' => 104,
                'menu_name' => 'specs.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Specifications',
                'parent_id' => 73,
                'order' => 2,
                'icon' => NULL,
                'created_at' => '2019-11-06 05:10:31',
                'updated_at' => '2019-11-06 07:11:19',
            ),
            11 => 
            array (
                'id' => 105,
                'menu_name' => 'features.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Features',
                'parent_id' => 73,
                'order' => 3,
                'icon' => NULL,
                'created_at' => '2019-11-06 05:43:20',
                'updated_at' => '2019-11-06 07:11:19',
            ),
            12 => 
            array (
                'id' => 124,
                'menu_name' => 'model.compare',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Compare Models',
                'parent_id' => 0,
                'order' => 9,
                'icon' => 'fas fa-compress',
                'created_at' => '2019-12-02 06:11:29',
                'updated_at' => '2020-02-20 08:05:11',
            ),
            13 => 
            array (
                'id' => 135,
                'menu_name' => 'category.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Model Category',
                'parent_id' => 0,
                'order' => 6,
                'icon' => 'fab fa-accusoft',
                'created_at' => '2019-12-31 04:45:06',
                'updated_at' => '2020-02-20 08:05:10',
            ),
            14 => 
            array (
                'id' => 147,
                'menu_name' => 'posts.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Posts',
                'parent_id' => 0,
                'order' => 7,
                'icon' => 'fas fa-paperclip',
                'created_at' => '2020-01-14 06:29:17',
                'updated_at' => '2020-02-20 08:05:10',
            ),
            15 => 
            array (
                'id' => 150,
                'menu_name' => 'post-category.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Post Category',
                'parent_id' => 0,
                'order' => 8,
                'icon' => 'fab fa-bandcamp',
                'created_at' => '2020-01-15 06:41:36',
                'updated_at' => '2020-02-20 08:05:10',
            ),
            16 => 
            array (
                'id' => 169,
                'menu_name' => 'divisions.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Divisions',
                'parent_id' => 176,
                'order' => 2,
                'icon' => NULL,
                'created_at' => '2020-02-20 08:07:44',
                'updated_at' => '2020-02-20 08:16:10',
            ),
            17 => 
            array (
                'id' => 176,
                'menu_name' => '#DivisionSetup',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Division Setup',
                'parent_id' => 0,
                'order' => 10,
                'icon' => 'fas fa-layer-group',
                'created_at' => '2020-02-20 08:05:04',
                'updated_at' => '2020-02-20 08:06:47',
            ),
            18 => 
            array (
                'id' => 177,
                'menu_name' => 'sub-division.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Sub-Divisions',
                'parent_id' => 176,
                'order' => 3,
                'icon' => NULL,
                'created_at' => '2020-02-20 09:17:09',
                'updated_at' => '2020-02-20 09:17:28',
            ),
            19 => 
            array (
                'id' => 183,
                'menu_name' => 'attribute.index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Attributes',
                'parent_id' => 73,
                'order' => 4,
                'icon' => 'fab fa-amilia',
                'created_at' => '2020-03-20 04:44:40',
                'updated_at' => '2020-03-20 04:45:11',
            ),
            20 => 
            array (
                'id' => 189,
                'menu_name' => 'sub-attribute-index',
                'parameters' => NULL,
                'route' => NULL,
                'display_name' => 'Sub Attributes',
                'parent_id' => 73,
                'order' => 5,
                'icon' => NULL,
                'created_at' => '2020-03-20 05:08:00',
                'updated_at' => '2020-03-20 05:08:22',
            ),
        ));
        
        
    }
}