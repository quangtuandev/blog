<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Facades\ {
    App\Services\PassportService,
    App\Services\SocialService,
    Laravel\Socialite\Contracts\Factory as Provider
};
use App\Models\SocialAccount;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return  Provider::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $driver =  Provider::driver($provider);

        $user = SocialService::createOrGetUser($driver);

        return redirect('/')->with('access_token', PassportService::getTokenByUser($user));
    }
}
