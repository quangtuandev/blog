<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Media;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Media::truncate();
        factory(Post::class, 10)->create()->each(function ($post) {
            $range = rand(2, 5);
            // Save photo for post
            $post->media()->saveMany(factory(Media::class, $range)->make());
        });
        
    }
}
