<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentPostRequest;
use App\Modules\Services\CommentService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected CommentService $commentService;

    public function __construct(
        CommentService $commentService
    ) {
        $this->commentService = $commentService;
    }

    public function store(CommentPostRequest $request)
    {
        $validated = $request->validated();
        if(Auth::id() == true) {
            $validated['name'] = auth()->user()->name;
        }
        $this->commentService->storeComment($validated);

        return redirect()->back();
    }

    public function storeReply(CommentPostRequest $request)
    {
        $validated = $request->validated();
        if(Auth::id() == true) {
            $validated['name'] = auth()->user()->name;
        }
        $validated['parent_id'] = $request->get('comment_id');
        $this->commentService->storeComment($validated);

        return redirect()->back();
    }
}