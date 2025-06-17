<?php

namespace App\Services;

use App\Repositories\BaseRepository;

class BaseService
{

    protected BaseRepository $repo;

    public function __construct(BaseRepository $repo)
    {
        $this->repo = $repo;
    }


    public function find(int $id)
    {
        return $this->repo->find($id);
    }
    public function findBy($data)
    {
        return $this->repo->findBy($data);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }

}