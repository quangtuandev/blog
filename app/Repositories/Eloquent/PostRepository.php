<?php

namespace App\Repositories\Eloquent;

use Auth;
use Exception;
use App\Models\Post;
use App\Models\Media;
use App\Models\User;
use App\Repositories\Contracts\PostInterface;
use App\Exceptions\Api\UnknowException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostRepository extends BaseRepository implements PostInterface
{

    public function model()
    {
        return Post::class;
    }

    public function getPost($post){
        // dd($post);
        $post['user'] = $post->getInfoBasicUser($post['user_id']);
        $post['media'] = $post->media()->pluck('url');
        $post['tags'] =  $post->tags()->select(['tags.id','name'])->get();
        $post['categories'] =  $post->categories()->select(['categories.id','name'])->get();
        return[
            'post' => $post
        ];
    }
    public function getReviewPost($post){
        $post['review'] = $post->reviews()
        ->where('post_id',$post['id'])
        ->paginate(config('settings.paginate_review'));
        $data=$post['review']->items();
        foreach ($data as $review) {
            $review->user = $review->getReviewer($review['user_id']);
        }

        return[
            'review' => $post['review']
        ];
    }
    public function create($inputs){
        // dd($inputs);
        if (is_null($inputs) || !is_array($inputs)) {
            throw new UnknowException('Inputs is null or not an array');
        }
        $data = [
            'title' => $inputs['title'],
            'content' => $inputs['content'],
            'description' => empty($inputs['description']) ? null : $inputs['description'],
            'image' => empty($inputs['image']) ? config('settings.default_avatar') : $inputs['image'],
            'user_id' =>  $inputs['user_id'],
        ];
        $post = parent::create($data);

        if (!$post) {
            throw new NotFoundException('Error create post');
        }

        if ($inputs['tags'] && is_array($inputs['tags'])) {
            $post->tags()->attach($inputs['tags']['old']);
            $post->tags()->createMany($inputs['tags']['new']);
        }

        foreach ($inputs['categories'] as $category) {
            $post->categories()->attach($category['id']);
        }

        return "You have created post successfully.";
    }

    public function searchPost($keyword)
    {
        $this->setGuard('api');
        $resutPost = $this->search($keyword)
        // ->where('status', USER::ACTIVE)
        ->groupBy('created_at')
        ->orderBy('created_at', 'DESC')
        ->select(array('id','name','email','specialize','image'))
        ->get();
        // $data = $resutPost->items();
        foreach ($resutPost as $post) {
            $post['overView'] = $this->getOverView($post);
        }
        return [
            'posts' => $resutPost,
            'totalPost' => $resutPost->count(),
        ];
    }

    public function getOverView($post){
        $reviews = $post->reviews()
        ->where('post_id',$post['id'])
        ->get();
        $info['count']  = $reviews->count();
        $info['avg'] = $reviews->avg('rating');
        $info['star'] = round($reviews->avg('rating'));
        return $info;
    }
}
