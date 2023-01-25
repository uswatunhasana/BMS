<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Services\NewsService;
use App\Modules\Services\CategoryService;

class NewsController extends Controller
{
    protected NewsService $newsService;

    protected CategoryService $categoryService;

    public function __construct(
        NewsService $newsService,
        CategoryService $categoryService
    ) {
        $this->newsService = $newsService;
        $this->categoryService = $categoryService;
    }

    public function sidebarData()
    {
        $categories = $this->categoryService->execute();
        $tags = $this->newsService->getAllTags();
        $posts = $this->newsService->recentNews();
        return compact('categories', 'tags', 'posts');
    }

    public function index(Request $request)
    {
        if ($request->has('search')){
            $datas = $this->newsService->searchNews($request->search);
        } else {
            $datas = $this->newsService->paginateBySlug();
        }
        $sidebar = $this->sidebarData();
        return view('frontend.pages.news_index', compact('sidebar', 'datas'));
    }

    public function show($slug)
    {
        $data = $this->newsService->getBySlug($slug);
        $sidebar = $this->sidebarData();
        $sidebar['posts'] = $this->newsService->recentNewsInDetails($slug);
        return view('frontend.pages.news_detail', compact('data', 'sidebar'));
    }

    public function listByCategory($category)
    {
        $datas = $this->newsService->paginatebyCategory($category);
        $sidebar = $this->sidebarData();
        return view('frontend.pages.news_index', compact('datas', 'sidebar'));
    }

    public function listByTags($tags)
    {
        $datas = $this->newsService->paginatebyTag($tags);
        $sidebar = $this->sidebarData();
        return view('frontend.pages.news_index', compact('datas', 'sidebar'));
    }
}
