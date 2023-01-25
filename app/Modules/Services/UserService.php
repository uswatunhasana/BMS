<?php

namespace App\Modules\Services;

use App\Modules\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Auth;
use App\Modules\Services\ApplicationServiceInterface;

final class UserService implements ApplicationServiceInterface
{

    protected EloquentUserRepository $repository;

    public function __construct(
        EloquentUserRepository $repository

    ) {
        $this->repository = $repository;
    }

    public function execute($dto = null)
    {
        $users = $this->repository->getAllForPublic();
        return $users;
    }

    public function storeUser($data)
    {
        $response = $this->repository->create($data);
        return $response;
    }

    public function getUserById($id)
    {
        $response = $this->repository->getUserById($id);
        return $response;
    }

    public function update($id, $data)
    {
        $response= $this->repository->updateUser($id,$data);
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

    public function restoreUser($id)
    {
        return $this->repository->restoreUser($id);
    }

    public function restoreAllUser()
    {
        return $this->repository->restoreAllUser();
    }

}
