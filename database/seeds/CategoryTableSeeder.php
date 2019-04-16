<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $categories = [
            'sport',
            'music',
            'fashion',
            'love',
        ];

        foreach ($categories as $value) {
            factory(Category::class)->create([
                'name' => $value
            ]);
        }
    }
}
