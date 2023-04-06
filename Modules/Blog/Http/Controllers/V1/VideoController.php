<?php

namespace Modules\Blog\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Video;

class VideoController extends Controller
{
    /**
     * Store a newly created post in storage.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {

    }

    /**
     * Show the video resource.
     * @param Video $video
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Video $video): \Illuminate\Http\JsonResponse
    {
        return apiResponse()->respond($video);
    }
}
