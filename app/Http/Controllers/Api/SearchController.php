<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserInterface;
use App\Repositories\Contracts\TeacherInterface;

class SearchController extends ApiController
{
    private $userRepository;
    private $teacherRepository;

    public function __construct(
        UserInterface $userRepository,
        TeacherInterface $teacherRepository
        ) {        
            parent::__construct();
            $this->userRepository = $userRepository;
            $this->teacherRepository = $teacherRepository;
        }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        return $this->getData(function () use ($keyword) {
          
                $resultUser = $this->userRepository->searchUser($keyword);
                $this->compacts['users'] = $resultUser['users'];
                $this->compacts['totalUser'] = $resultUser['totalUser'];

                $resultTeacher = $this->teacherRepository->searchTeacher($keyword);
                $this->compacts['teachers'] = $resultTeacher['teachers'];
                $this->compact['totalTeacher'] = $resultTeacher['totalTeacher'];
        });
    }
}
