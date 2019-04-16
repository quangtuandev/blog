<?php
namespace App\Repositories\Eloquent;

use Exception;
use App\Models\ReviewPost;
use App\Exceptions\Api\UnknowException;
use App\Repositories\contracts\ReviewPostInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;

class ReviewPostRepository extends BaseRepository implements ReviewPostInterface
{
    public function model(){
        return ReviewPost::class;
    }

    public function getReview($review){
        
        $info['user'] = $review->getReviewer($review['user_id']);
        $info['post'] = $review->getPostOfReview($review['post_id']);
        return
        [
            'review'=>$review,
            'info_review'=>$info
        ];
    }

    public function getLastest(){
        $reviews = $this->orderBy('created_at', 'desc')->take(10)->get();
        foreach ($reviews as $review) {
            $listReview[] = $this->getReview($review);
        }
       
        return [
            'reviews' => $listReview
        ];
       
    }
    public function getReviewByUser($userId){
        $reviews = $this->model->where('user_id', $userId)
        ->paginate(config('settings.paginate_review'));
        $data=$reviews->items();
        foreach ($data as $review) {
            $review->post = $review->getPostOfReview($review['post_id']);
        }
        return $reviews;
    }

    public function createReviewPost($data)
    {
        if (is_null($data) || !is_array($data)) {
            throw new UnknowException('Inputs is null or not an array');
        }
        $inputs = [
            'name' => $data['title'],
            'description' => $data['content'],
            'status' => ReviewPost::BLOCK,
            'number_of_likes' => 0,
            'rating' => $data['star'],
            'user_id' => Auth::user()->id,
            'post_id' => $data['post_id'],
        ];

        $review = parent::create($inputs);

        if (!$review) {
            throw new NotFoundException('Error create review');
        }

        return [
            'messenger' =>"You have created review post successfully.",
            'id' => $review->id
        ];
    }
}
