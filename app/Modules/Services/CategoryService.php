<?php

namespace App\Modules\Services;

use App\Modules\Repositories\EloquentCategoryRepository;
use App\Modules\Services\ApplicationServiceInterface;

final class CategoryService implements ApplicationServiceInterface
{
    protected EloquentCategoryRepository $repository;

    public function __construct(
        EloquentCategoryRepository $repository

    ) {
        $this->repository = $repository;
    }

    public function execute($dto = null)
    {
        $users = $this->repository->getAllForPublic();
        return $users;
    }

    public function storeCategory($data)
    {
        $response = $this->repository->create($data);
        return $response;
    }

    public function getById($id)
    {
        $response = $this->repository->getById($id);
        return $response;
    }

    public function update($id, $data)
    {
        $response= $this->repository->update($id,$data);
        return $response;
    }

    public function delete($id)
    {
        return $this->repository->delete([
            'id' => $id
        ]);
    }
    public function forceDelete($id)
    {
        return $this->repository->forceDelete($id);
    }

    public function restoreCategory($id)
    {
        return $this->repository->restoreCategory($id);
    }

    public function restoreAllCategory()
    {
        return $this->repository->restoreAllCategory();
    }
}
