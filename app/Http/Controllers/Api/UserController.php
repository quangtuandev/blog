<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiController;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Contracts\RoleInterface;
use App\Repositories\Contracts\ReviewPostInterface;
use Carbon\Carbon;
use Hash;
use App\Models\User;
use App\Models\Role;
use Exception;
use App\Http\Requests\ImageUploadRequest;

class UserController extends ApiController
{
   
    protected $roleRepository;
    protected $reviewRepository;

    public function __construct(
        UserInterface $userRepository,
        RoleInterface $roleRepository,
        ReviewPostInterface $reviewRepository    
    ) {
        parent::__construct($userRepository);
        $this->roleRepository = $roleRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function authUser()
    {
        return $this->user->load([
            'roles' => function ($query) {
                $query->where('type', Role::TYPE_SYSTEM);
            }
        ]);
    }

   public function show($id){
        $user = $this->repository->findOrFail($id);
        return $this->getData(function () use ($user){
            $this->compacts['user_profile'] = $this->repository->getProfile($user);
        });
   }

   public function getReview($userId){
        return $this->getData(function () use($userId){
            $this->compacts['review'] = $this->reviewRepository->getReviewByUser($userId);
        });
   }
}
