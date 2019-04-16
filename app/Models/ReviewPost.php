<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewPost extends BaseModel
{
    use SoftDeletes;
    const BLOCK = 0;
    const ACTIVE = 1;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'name',
        'description',
        'status',
        'number_of_likes',
        'rating',
        'user_id',
        'post_id',
        'deleted_at',
    ];

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function getReviewer($userId){
         $findUser = $this->user()
         ->where('id',$userId)
         ->select('id','name','email','avatar')
         ->first();
         return $findUser;
    }
    
    public function getPostOfReview($postId){
        $findPost = $this->post()
        ->where('id',$postId)
        ->select('id','name','email')
        ->first();
        return $findPost;
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

}
