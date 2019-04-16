<?php 
namespace App\Repositories\Contracts;

interface UserInterface
{
    public function active($token);
    public function register($inputs, $roleId);
    public function getProfile($user);
    public function searchUser($keyword);
}