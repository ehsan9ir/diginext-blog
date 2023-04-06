<?php

namespace Modules\Blog\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\PostStorerequest;

class PostController extends Controller
{
    /**
     * Store a newly created post in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PostStorerequest $request): \Illuminate\Http\JsonResponse
    {
        return apiResponse()->respond(
            Post::create($request->validated())
        );
    }

    /**
     * Show the User resource.
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post): \Illuminate\Http\JsonResponse
    {
        return apiResponse()->respond($post);
    }
}
