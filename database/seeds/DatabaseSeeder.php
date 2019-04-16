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
        $this->call(UserTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(ReviewTableSeeder::class);
        $this->call(TagTableSeeder::class);
        
        // DB::table('users')->where('id',2)->update(['password'=>bcrypt('admin@123'),'status'=>true,'email'=>'quangtuandev@gmail.com']);
    }
}
