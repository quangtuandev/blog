<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Exceptions\Api\UnknowException;
use App\Http\Requests\ReviewPostRequest;
use App\Repositories\Contracts\ReviewPostInterface;


class ReviewTeacherController extends ApiController
{
    protected $reviewTeacherRepository;

    public function __construct(
        ReviewTeacherInterface $reviewTeacherRepository
    ) {
        parent::__construct();
        $this->reviewTeacherRepository = $reviewTeacherRepository;
    }

    public function show($id)
    {
        $review = $this->reviewTeacherRepository->findOrFail($id);
        return $this->getData(function () use ($review) {
            $this->compacts['detail_review'] = $this->reviewTeacherRepository->getReview($review);
        });
    }
    
    public function getLastest()
    {
        return $this->getData(function (){
           $this->compacts['review_lastest'] = $this->reviewTeacherRepository->getLastest(); 
        });
    }

    public function createReviewTeacher(ReviewTeacherRequest $request)
    {
        $data =$request->only(
            'title',
            'content',
            'star',
            'teacher_id'
        );
        return $this->doAction(function () use($data){
            $this->compacts['review'] = $this->reviewTeacherRepository->createReviewTeacher($data);
        });
    }

    public function deleteReviewTeacher($id)
    {
        $review = $this->reviewTeacherRepository->findOrFail($id);

        if ($this->user->cant('delete', $review)) {
            throw new UnknowException("Permission error: User can not delete this action.");
        }

        return $this->doAction(function () use ($review) {
            $this->compacts['reivew'] = $review->delete();
        });
    }
}
