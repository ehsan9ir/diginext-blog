<?php

namespace Modules\Blog\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\CommentStoreRequest;
use Modules\Blog\Http\Requests\PostStorerequest;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Store a newly created Post in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostStorerequest $request): \Illuminate\Http\JsonResponse
    {
        return apiResponse()->respond(
            Post::create($request->validated(), Response::HTTP_CREATED)
        );
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
        return apiResponse()->respond(
            $post->comments()->create($request->validated()),
            Response::HTTP_CREATED
        );
    }
}
