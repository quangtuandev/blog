<?php
namespace App\Repositories\Contracts;

interface ReviewPostInterface extends RepositoryInterface
{
    public function getReview($review);

    public function getLastest();

    public function getReviewByUser($userId);

    public function createReviewPost($data);
}