<?php

namespace Modules\Blog\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\CommentStoreRequest;
use Modules\Blog\Http\Requests\PostStorerequest;
use Modules\Blog\Repositories\PostRepository;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Store a newly created Post in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostStorerequest $request): \Illuminate\Http\JsonResponse
    {
        $post = $this->postRepository->store($request->validated());

        return apiResponse()->respond($post, Response::HTTP_CREATED);
    }

    /**
     * Show the Post resource.
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post): \Illuminate\Http\JsonResponse
    {
        return apiResponse()->respond($post);
    }

    /**
     * @param Post $post
     * @param CommentStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeComment(Post $post, CommentStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $comment = $this->postRepository->storeComment($post, $request->validated());

        return apiResponse()->respond($comment, Response::HTTP_CREATED);
    }
}
