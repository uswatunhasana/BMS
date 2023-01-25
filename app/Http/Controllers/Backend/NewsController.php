<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Services\NewsService;
use App\Modules\Services\CategoryService;
use App\DataTables\NewsDataTable;
use App\DataTables\NewsTrashedDatatable;
use App\Http\Requests\NewsPostRequest;
use App\Http\Requests\NewsUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class NewsController extends Controller
{    
    protected NewsService $newsService;

    public function __construct(
        NewsService $newsService
    ) {
        $this->newsService = $newsService;
    }

    public function index(NewsDataTable $datatables)
    {
        return $datatables->render('backend.pages.news.index');
    }

    public function create(CategoryService $categoryService)
    {
        $categories = $categoryService->execute();
        return view('backend.pages.news.create', compact('categories'));
    }

    public function store(NewsPostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $file = $validated['thumbnail'];
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $nama_file);
        $validated['thumbnail'] = $nama_file;
        $this->newsService->store($validated);
        Alert::success(' Berhasil Tambah Data ', ' Silahkan Periksa Kembali');
        return redirect()->route('news.index');
    }

    public function edit(CategoryService $categoryService, $id)
    {
        $data = $this->newsService->getById($id);
        if (count($data->tags) > 0) {
            foreach ($data->tags as $tag) {
                $tagsinput[] = $tag->name;
            }
            $arrTags = implode(',', $tagsinput);
        } else {
            $arrTags[] = null;
        }
        $categories = $categoryService->execute();
        return view('backend.pages.news.edit', compact('data', 'categories', 'arrTags'));
    }

    public function update(NewsUpdateRequest $request, $id)
    {
        $data = $this->newsService->getById($id);
        $validated = $request->validated();
        $validated['updated_by'] = auth()->user()->id;
        $validated['user_id'] = $data->user_id;
        if (isset($request->thumbnail)) {
            $path = public_path() . '/uploads/';
            if ($data->thumbnail != '' && $data->thumbnail != null) {
                $file_old = $path . $data->thumbnail;
                unlink($file_old);
            }
            $filenew = $validated['thumbnail'];
            $update_file = rand() . $filenew->getClientOriginalName();
            $filenew->move(public_path('uploads'), $update_file);
            $validated['thumbnail'] = $update_file;
        }
        $this->newsService->update($id, $validated);
        Alert::success(' Berhasil Ubah Data ', ' Silahkan Periksa Kembali');
        return redirect()->route('news.index');
    }

    public function tagsSuggest()
    {
        $suggestions = $this->newsService->getAllTags();
        if (count($suggestions) > 0) {
            foreach ($suggestions as $suggest) {
                $tagSuggets[] = $suggest->name;
            }
        } else {
            $tagSuggets[] = null;
        }
        return response()->json($tagSuggets);
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $news_id = $this->newsService->delete($request->id);
        return response()->json($news_id);
    }
    
    public function forceDelete(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $news_id = $this->newsService->forceDelete($request->id);
        return response()->json($news_id);
    }
    
    public function trashData (NewsTrashedDatatable $datatables)
    {
        return $datatables->render('backend.pages.trash.news');
    }

    public function restore($id)
    {
        $this->newsService->restoreNews($id);
        return redirect()->back();
    }

    public function restoreAll()
    {
        $this->newsService->restoreAllNews();
        return redirect()->back();
    }

}
