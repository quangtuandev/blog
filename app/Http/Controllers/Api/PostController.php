<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Repositories\Contracts\PostInterface;
use App\Repositories\Contracts\TagInterface;

class PostController extends ApiController
{
    private $postRepository;
    private $tagRepository;

    public function __construct(
        PostInterface $postRepository,
        TagInterface $tagRepository
    ) {
        parent::__construct();
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
    }
       /**
     * @SWG\Get(
     *     path="/api/teacher/show/{id}",
     *     tags={"Teacher"},
     *     summary="get teacher's infomation",
     *     description="Return a user's first and last name",
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         type="integer",
     *         description="Id teacher",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing ID"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Server errors"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="not found"
     *     ),
     * )
     */
    public function show($id)
    {
        $post = $this->postRepository->findOrFail($id);

        return $this->getData(function () use ($post) {
            $this->compacts['detail_posts'] = $this->postRepository->getPost($post);
        });
    }
    /**
     * @SWG\Get(
     *     path="/api/teacher/{id}/review",
     *     tags={"Teacher"},
     *     summary="get teacher's review",
     *     description="",
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         type="integer",
     *         description="Id teacher",
     *         required=true,
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *     @SWG\Response(
     *         response=422,
     *         description="Missing ID"
     *     ),
     *     @SWG\Response(
     *         response=500,
     *         description="Server errors"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="not found"
     *     ),
     * )
     */
    
    public function getReviewTeacher($id)
    {
        $teacher = $this->postRepository->findOrFail($id);
        return $this->getData(function () use ($teacher) {
            $this->compacts['review_teachers'] = $this->postRepository->getReviewTeacher($teacher);
        });
    }
    /**
     * @SWG\Post(
     *     path="/api/teacher/new",
     *     tags={"Teacher"},
     *     operationId="addTeacher",
     *     summary="Add a new teacher",
     *     description="",
     *     consumes={"application/json", "application/xml"},
     *     produces={"application/xml", "application/json"},
     *     @SWG\Parameter(
     *         name="name",
     *         in="formData",
     *         type="string",
     *         description="teacher's name",
     *         required=true,
     *     ),     
     *     @SWG\Parameter(
     *         name="birthday",
     *         in="formData",
     *         type="string",
     *         format="date",
     *         description="teacher's birthday",
     *         required=true,
     *     ),     
     *     @SWG\Parameter(
     *         name="gender",
     *         in="formData",
     *         type="integer",
     *         description="teacher's gender",
     *         required=true,
     *     ),     
     *     @SWG\Parameter(
     *         name="address",
     *         in="formData",
     *         type="string",
     *         description="teacher's address",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="specialize",
     *         in="formData",
     *         type="string",
     *         description="teacher's specialize",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="description",
     *         in="formData",
     *         type="string",
     *         description="teacher's description",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="phone",
     *         in="formData",
     *         type="integer",
     *         description="teacher's phone",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="image",
     *         in="formData",
     *         type="string",
     *         description="teacher's image",
     *         
     *     ),     
     *     @SWG\Parameter(
     *         name="identity_card",
     *         in="formData",
     *         type="string",
     *         description="teacher's identity_card",
     *         
     *     ),
     *      @SWG\Parameter(
     *         name="email",
     *         in="formData",
     *         type="string",
     *         format="email",
     *         description="teacher's email",
     *         
     *     ),
     *     @SWG\Response(
     *         response=405,
     *         description="Invalid input",
     *     ),
     *     security={{"auth":{"*":"777"}}}
     * )
     */
    public function store(PostRequest $request){

        $data = $request->only(
            'title',
            'image',
            'content',
            'description',
            'categories',
            'tags'
        );
        $data['user_id'] = $this->user->id;
        return $this->doAction(function () use ($data) {
            $data['tags'] = $this->tagRepository->getOrCreate($data['tags']);
            $this->compacts['message'] = $this->postRepository->create($data);
        });
    }
    
    public function listPhotos($id){
        $teacher = $this->postRepository->findOrFail($id);
        return $this->getData(function () use ($teacher){
            $this->compacts['url_images'] = $this->postRepository->getTeacherPhotos($teacher);
        });
    }

    public function getOverView($id){
        $teacher = $this->postRepository->findOrFail($id);
        return $this->getData(function () use ($teacher){
            $this->compacts['over_view'] = $this->postRepository->getOverView($teacher);
        });
    }
}
