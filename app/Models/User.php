<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable,SearchableTrait, SoftDeletes;
    const IN_ACTIVE = 0;
    const ACTIVE = 1;
    const BAN = 2;
    const ACTIVE_LINK_SEND = 'emails.active';
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'avatar',
        'address',
        'phone',
        'status',
        'token_confirm',
        'gender',
        'about',
        'deleted_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
        
    ];
    
    protected $searchable = [
        'columns' => [
            'users.name' => 10,
            'users.email' => 9,
        ],
    ];
    protected $dates = ['deleted_at'];

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    public function reviews()
    {
        return $this->hasMany('App\Models\ReviewPost');
    }
    public function teachers()
    {
        return $this->hasMany('App\Models\Teacher');
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function hasRole($role)
    {
        $roleId = Role::whereName($role)->first()->id;

        return $this->roles()->wherePivot('role_id', $roleId)->exists();
    }

    public function getAbout($value = null)
    {
        if (!$value || !is_numeric($value)) {
            return $this->attributes['about'];
        }

        return str_limit($this->attributes['about'], $value);
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            // Set filtering params before creating that it executes saving
            $user->token_confirm = Str::random(60);
            $user->birthday = is_null($user->birthday) ? null : Carbon::parse($user->birthday);
            $user->avatar = $user->avatar ?: config('settings.default_avatar');
            $user->gender = is_null($user->gender) ? 0 :$user->gender;
        });
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getBirthdayAttribute($date)
    {
        return Carbon::parse($date)->toDateString();
    }

}