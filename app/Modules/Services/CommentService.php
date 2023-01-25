<?php

namespace App\Modules\Services;

use App\Modules\Repositories\EloquentCommentRepository;
use App\Modules\Services\ApplicationServiceInterface;

final class CommentService implements ApplicationServiceInterface
{
    protected EloquentCommentRepository $repository;

    public function __construct(
        EloquentCommentRepository $repository

    ) {
        $this->repository = $repository;
    }

    public function execute($dto = null)
    {
        $users = $this->repository->getAllForPublic();
        return $users;
    }

    public function storeComment($data)
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

    public function restoreComment($id)
    {
        return $this->repository->restoreComment($id);
    }

    public function restoreAllComment()
    {
        return $this->repository->restoreAllComment();
    }
}
