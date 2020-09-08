<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(RoleUserTableSeeder::class);
        $this->call(MenusTableSeeder::class);
//        $this->call(SpecificationsTableSeeder::class);
//        $this->call(FeaturesTableSeeder::class);
//        $this->call(CategoriesTableSeeder::class);
//        $this->call(PostsTableSeeder::class);
//        $this->call(PostCategoriesPivotTableSeeder::class);
//        $this->call(AttributesTableSeeder::class);
//        $this->call(SubAttributesTableSeeder::class);
//        $this->call(DivisionsTableSeeder::class);
//        $this->call(SubDivisionsTableSeeder::class);
    }
}
