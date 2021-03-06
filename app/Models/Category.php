<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use SoftDeletes;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id',
        'name',
    ];

    protected $dates = ['deleted_at'];


    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
