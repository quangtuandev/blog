<?php

namespace App\Models;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * @SWG\Definition()
 */ 
class Post extends BaseModel
{
    use SoftDeletes,SearchableTrait;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'title',
        'description',
        'image',
        'content',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    protected $searchable = [
        'columns' => [
            'posts.title' => 9,
        ],
    ];

    public function reviews()
    {
        return $this->hasMany('App\Models\ReviewPost');
    }

    public function getReviewOfPost($postId)
    {
        return $this->reviews()->where('post_id',$postId)->paginate(config('settings.paginate_review'));
    }

    public function getReview($postId){
        
        dd($this->reviews()->where('post_id',$postId)->get());
        return 0;
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getInfoBasicUser($id)
    {
        return  $this->user()
        ->where('id',$id)
        ->select('name','email','avatar')
        ->first();   
    }
}
