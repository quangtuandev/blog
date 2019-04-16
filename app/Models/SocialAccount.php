<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAccount extends BaseModel
{
    use SoftDeletes;

    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id',
        'user_id',
        'provider_id',
        'email',
        'name',
        'provider',
        'avatar',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
