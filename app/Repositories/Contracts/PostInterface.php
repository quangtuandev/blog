<?php

namespace App\Repositories\Contracts;

interface PostInterface extends RepositoryInterface
{
    public function getPost($post);

    public function getReviewPost($post);

    public function create($inputs);

    public function searchPost($keyword);
    
    public function getOverView($post);
}
