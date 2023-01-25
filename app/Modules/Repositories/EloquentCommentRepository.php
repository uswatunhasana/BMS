<?php

namespace App\Modules\Repositories;

use App\Models\Comment;

class EloquentCommentRepository
{
    private Comment $model;

    public function __construct(
        Comment $model
    ) {
        $this->model = $model;
    }
 
    public function getAllForPublic($limit = 5)
    {
        return $this->model->newQuery()->orderBy('created_at','desc')->get();
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

    public function restoreComment($id)
    {
        return $this->model->withTrashed()->find($id)->restore();
    }

    public function restoreAllComment()
    {
        return $this->model->onlyTrashed()->restore();
    }

    public function forceDelete($id)
    {
        return $this->model->onlyTrashed()->find($id)->forceDelete();
    }
}
