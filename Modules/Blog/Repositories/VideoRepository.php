<?php


namespace Modules\Blog\Repositories;


use Modules\Blog\Entities\Video;

class VideoRepository extends Repository
{

    public function model()
    {
        return Video::class;
    }
}
