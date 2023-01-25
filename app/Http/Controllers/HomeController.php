<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Services\NewsService;
use App\Modules\Services\CategoryService;
use App\Modules\Services\UserService;
use App\Models\User;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(
        CategoryService $categoryService, 
        NewsService $newsService, 
        User $model)
    {
        $categories = $categoryService->execute();
        $news= $newsService->execute();
        $writerCount= $model->where('role','2')->count();
        $adminCount= $model->where('role','1')->count();
        return view('backend.pages.home', compact('categories', 'news', 'writerCount', 'adminCount'));
    }
}
