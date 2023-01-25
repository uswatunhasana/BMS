<?php

namespace App\Modules\Services;

use App\DTO\NewsDTO;
use App\Modules\Repositories\EloquentNewsRepository;
use App\Modules\Services\ApplicationServiceInterface;


final class NewsService implements ApplicationServiceInterface
{
    protected EloquentNewsRepository $repository;

    public function __construct(
        EloquentNewsRepository $repository
    ) {
        $this->repository = $repository;
    }

    public function execute($dto = null)
    {
        $datas = $this->repository->getAllForPublic($dto);

        return $datas;
    }

    public function store($data)
    {
        $response = $this->repository->create($data);
        return $response;
    }

    public function getBySlug($slug)
    {
        $response = $this->repository->getNewsBySlug($slug);
        return $response;
    }

    public function getAllTags($dto = null)
    {
        $response = $this->repository->getAllTags();
        return $response;
    }
    
    public function getById($id)
    {
        $response = $this->repository->getById($id);
        return $response;
    }
    
    public function update($id, $data)
    {
        $response= $this->repository->updateNews($id,$data);
        return $response;
    }

    public function recentNews()
    {
        $response = $this->repository->recentNews();
        return $response;
    }

    public function recentNewsInDetails($slug)
    {
        $response = $this->repository->recentNewsInDetails($slug);
        return $response;
    }

    public function paginateBySlug( $dto = null)
    {
        $response = $this->repository->paginateBySlug();
        return $response;
    }

    public function paginatebyCategory($category)
    {
        $response = $this->repository->paginateByCategory($category);
        return $response;
    }

    public function paginatebyTag($tags)
    {
        $response = $this->repository->paginateByTags($tags);
        return $response;
    }

    public function searchNews($search)
    {
        $response = $this->repository->searchNews($search);
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

    public function restoreNews($id)
    {
        return $this->repository->restoreNews($id);
    }

    public function restoreAllNews()
    {
        return $this->repository->restoreAllNews();
    }

    public function trashNews()
    {
        return $this->repository->trashNews();
    }
}
