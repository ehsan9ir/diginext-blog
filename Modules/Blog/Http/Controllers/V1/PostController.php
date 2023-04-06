<?php

namespace Modules\Blog\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

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
