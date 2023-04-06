<?php

namespace Modules\Blog\Http\Controllers\V1;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\Video;
use Modules\Blog\Http\Requests\VideoStoreRequest;

class VideoController extends Controller
{
    /**
     * Store a newly created post in storage.
     * @param VideoStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VideoStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        return apiResponse()->respond(
            Video::create($request->validated())
        );
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
