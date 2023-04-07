<?php


namespace Modules\Blog\Repositories;

use Modules\Blog\Entities\Post;

class PostRepository extends Repository
{

    public function model()
    {
        return Post::class;
    }
}
