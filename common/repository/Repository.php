<?php

namespace common\repository;

abstract class  Repository implements RepositoryInterface
{
    protected $model;

    /**
     * @return mixed
     */
    public function instance()
    {
        return new $this->model;
    }
}