<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\CategoryInterface;

class CategoryRepository extends BaseRepository implements CategoryInterface
{

    public function model()
    {
        return Category::class;
    }

}
