<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Models\Role;
use App\Repositories\Contracts\UserInterface;
use App\Jobs\SendEmail;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Exceptions\Api\UnknowException;
use Notification;
use Carbon\Carbon;

class UserRepository extends BaseRepository implements UserInterface
{
    use DispatchesJobs;

    public function model()
    {
        return User::class;
    }

    public function active($token)
    {
        $user = $token ? $this->where('token_confirm', $token)->first() : false;

        if (!$user) {
            return false;
        }

        $this->update($user->id, [
            'status' => User::ACTIVE,
            'token_confirm' => null,
        ]);

        return $user;
    }

    public function register($inputs, $roleId)
    {
        $user = $this->create($inputs);
        if (!$user) {
            throw new UnknowException('Had errors while processing');
        }

        $user->roles()->attach($roleId);

        // Send email active to user
        $info = [
            'email' => $inputs['email'],
            'subject' => trans('emails.active_subject'),
        ];

        $fields = [
            'object' => $user->name,
            'linkActive' => action('Frontend\UserController@active',$user->token_confirm),
        ];

        $this->dispatch(new SendEmail($info, User::ACTIVE_LINK_SEND, $fields));

        return true;
    }

    public function getProfile($user){
        $user['basic_info'] = [
            'id' => $user->id,
            'about' => $user->about,
            'name' => $user->name,
            'gender' => $user->gender,
            'birthday' => $user->birthday,
            'email' => $user->email,
            'phone' => $user->phone,
            'avatar' => $user->avatar,
            'address' => $user->address,
        ];
        return[
            'info' => $user['basic_info']
        ];
    }

    public function searchUser($keyword)
    {
        $this->setGuard('api');
        $resutUser = $this->search($keyword)
            ->where('status', USER::ACTIVE)
            ->groupBy('created_at')
            ->orderBy('created_at', 'DESC')
            ->select(array('email','avatar','name','id'))
            ->get();

        return [
            'users' => $resutUser,
            'totalUser' => $resutUser->count(),
        ];
    }    

}
