<?php

use Illuminate\Database\Seeder;
use App\Models\ReviewPost;
class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReviewPost::truncate();
        factory(ReviewPost::class, 20)->create();
    }
}
