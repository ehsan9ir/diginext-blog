<?php

namespace Modules\Blog\Http\Controllers\V1;

use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Video;
use Modules\Blog\Http\Requests\CommentStoreRequest;
use Modules\Blog\Http\Requests\VideoStoreRequest;
use Symfony\Component\HttpFoundation\Response;

class VideoController extends Controller
{
    /**
     * Store a newly created Video in storage.
     * @param VideoStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VideoStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        return apiResponse()->respond(
            Video::create($request->validated(), Response::HTTP_CREATED)
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

    public function storeComment(Video $video, CommentStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        return apiResponse()->respond(
            $video->comments()->create($request->validated()),
            Response::HTTP_CREATED
        );
    }
}
