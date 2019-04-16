<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    protected static $repositories = [
        'user' => [
            \App\Repositories\Contracts\UserInterface::class,
            \App\Repositories\Eloquent\UserRepository::class,
        ],
        'role' => [
            \App\Repositories\Contracts\RoleInterface::class,
            \App\Repositories\Eloquent\RoleRepository::class,
        ],
        'social_account' => [
            \App\Repositories\Contracts\SocialAccountInterface::class,
            \App\Repositories\Eloquent\SocialAccountRepository::class,
        ],
        'tag' => [
            \App\Repositories\Contracts\TagInterface::class,
            \App\Repositories\Eloquent\TagRepository::class,
        ],
        'post' => [
            \App\Repositories\Contracts\PostInterface::class,
            \App\Repositories\Eloquent\PostRepository::class,
        ],
        'review' => [
            \App\Repositories\Contracts\ReviewPostInterface::class,
            \App\Repositories\Eloquent\ReviewPostRepository::class,
        ],
        'category' => [
            \App\Repositories\Contracts\CategoryInterface::class,
            \App\Repositories\Eloquent\CategoryRepository::class,
        ],
    ];
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (static::$repositories as $repository) {
            $this->app->singleton(
                $repository[0],
                $repository[1]
            );
        }
    }
}
