<?php

namespace App\Modules\Repositories;

use App\Models\Category;

class EloquentCategoryRepository
{
    private Category $model;

    public function __construct(
        Category $model
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

    public function getById($id){
        return $this->model->where('id', $id)->first();
    }

    public function update($id, $data)
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function restoreCategory($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }

    public function restoreAllCategory()
    {
        return $this->model->onlyTrashed()->restore();
    }

    public function forceDelete($id)
    {
        return $this->model->onlyTrashed()->find($id)->forceDelete();
    }
}
