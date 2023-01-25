<?php

namespace App\Modules\Repositories;

use App\Models\User;


class EloquentUserRepository
{
    private User $model;

    public function __construct(
        User $model
    ) {
        $this->model = $model;
    }

    public function getAllForPublic($limit = 5)
    {
        return $this->model->newQuery()->get();
    }

    public function create(array $data)
    {
        $model = $this->model->newQuery()->firstOrCreate($data);
        return $model->id;
    }

    public function getUserById($id){
        return $this->model->where('id', $id)->first();
    }

    public function countWriter(){
        return $this->model->where('role', 2 )->get();
    }

    public function updateUser($id, $data){
        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id){
        return $this->model->destroy($id);
    }

    public function restoreUser($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }

    public function restoreAllUser()
    {
        return $this->model->onlyTrashed()->restore();
    }

    public function forceDelete($id)
    {
        return $this->model->onlyTrashed()->find($id)->forceDelete();
    }
}
