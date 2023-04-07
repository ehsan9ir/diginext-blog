<?php

namespace Modules\Blog\Http\Controllers\V1;

use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Video;
use Modules\Blog\Http\Requests\CommentStoreRequest;
use Modules\Blog\Http\Requests\VideoStoreRequest;
use Modules\Blog\Repositories\VideoRepository;
use Symfony\Component\HttpFoundation\Response;

class VideoController extends Controller
{
    private $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * Store a newly created Video in storage.
     * @param VideoStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(VideoStoreRequest $request): \Illuminate\Http\JsonResponse
    {
        $video = $this->videoRepository->store($request->validated());

        return apiResponse()->respond($video, Response::HTTP_CREATED);
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
        $comment = $this->videoRepository->storeComment($video, $request->validated());

        return apiResponse()->respond($comment, Response::HTTP_CREATED);
    }
}
