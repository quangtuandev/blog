<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Contracts\CategoryInterface;

class CategoryController extends ApiController
{
    protected $categoryRepository;

    public function __construct(
        CategoryInterface $categoryRepository
    ) {
        parent::__construct();
        $this->categoryRepository = $categoryRepository;
    }

    public function show() 
    {
        return $this->getData(function () {
            $this->compacts['categories'] = $this->categoryRepository->select(['id','name'])->get();
        });
    }
}
