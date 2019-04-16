<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void UserTableSeeder
     */
    public function run()
    {
        User::truncate();
        factory(User::class, 20)->create();
    }
}
