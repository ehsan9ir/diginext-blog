<?php

namespace Modules\Blog\Repositories;

abstract class Repository
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    abstract public function model();

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function storeComment($model, array $data)
    {
        return $model->comments()->create($data);
    }
}
