<?php

namespace App\Modules\Repositories;

use App\Models\News;
use Conner\Tagging\Model\Tagged;

class EloquentNewsRepository
{
    private News $model;

    public function __construct(
        News $model
    ) {
        $this->model = $model;
    }

    public function getAllForPublic()
    {
        return $this->model->with('category', 'tagged','comments')->newQuery()->get();
    }

    public function getAllTags()
    {
        $modelTags = $this->model->existingTags();
        return $modelTags;
    }

    public function getById($id){
        return $this->model->where('id', $id)->first();
    }

    public function create(array $data)
    {
        foreach (json_decode($data['tags']) as $tag) {
            $output[] = $tag->value;
        }
        unset($data['tags']);
        $model = $this->model->newQuery()->firstOrCreate($data);
        $model->tag($output);
        return $model->id;
    }

    public function getNewsBySlug($slug)
    {
        return $this->model->with('tagged', 'category','comments')->where('slug', $slug)->first();
    }

    public function getNewsByCategory($category)
    {
        return $this->model->with('tagged', 'category','comments')->where('category_id', $category)->first();
    }

    public function paginateBySlug($perPage = 4, $columns = ['*'])
	{
		return $this->model->paginate($perPage, $columns);
	}

    public function paginateByCategory($category, $perPage = 4, $columns = ['*'])
	{
		return $this->model->whereHas('category', function($query) use ($category) {
            $query->where('name', 'LIKE', "%{$category}%");
        })->paginate($perPage, $columns);
	}

    public function paginateByTags($tag, $perPage = 4, $columns = ['*'])
	{
		return $this->model->whereHas('tagged', function($query) use ($tag) {
            $query->where('tag_name', 'LIKE', "%{$tag}%");
        })->paginate($perPage, $columns);
	}

    public function searchNews($search, $perPage = 4, $columns = ['*'])
	{
		return $this->model->where('title', 'LIKE', "%{$search}%")->orderBy('id')->paginate($perPage, $columns);
	}

    public function updateNews($id, $data)
    {
        foreach (json_decode($data['tags']) as $tag) {
            $output[] = $tag->value;
        }
        unset($data['tags']);
        $update = $this->model->with('category','tagged')->find($id);
        $update->retag($output);
        $update->update($data);
        return $update;
    }

    public function recentNews()
    {
        return $this->model->with('category', 'tagged')->latest()->take(4)->get();
    }

    public function recentNewsInDetails($slug)
    {
        return $this->model->with('category', 'tagged','comments')->where('slug','!=', $slug)->latest()->take(4)->get();
    }

    public function trashNews()
    {
        return $this->model->history()->onlyTrashed()->get();
    }

    public function restoreNews($id)
    {
        return $this->model->withTrashed()->where('id', $id)->restore();
    }

    public function restoreAllNews()
    {
        return $this->model->onlyTrashed()->restore();
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function forceDelete($id)
    {
        return $this->model->onlyTrashed()->find($id)->forceDelete();
    }
}
