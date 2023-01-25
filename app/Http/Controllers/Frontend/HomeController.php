<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Services\NewsService;

class HomeController extends Controller
{
    public function index(NewsService $newsService)
    {
        $posts = $newsService->recentNews();
        return view('frontend.pages.home', compact('posts'));
    }
}
