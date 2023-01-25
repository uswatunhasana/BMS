<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\DataTables\CategoryTrashedDatatable;
use App\Http\Requests\CategoryPostRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Modules\Services\CategoryService;
use App\Modules\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(
        CategoryService $categoryService
    ) {
        $this->categoryService = $categoryService;
    }

    public function index(CategoryDataTable $datatables)
    {
        return $datatables->render('backend.pages.category.index');
    }

    public function create()
    {
        return view('backend.pages.category.create');
    }

    public function store(CategoryPostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $this->categoryService->storeCategory($validated);
        Alert::success(' Berhasil Tambah Data ', ' Silahkan Periksa Kembali');
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $data = $this->categoryService->getById($id);
        return view('backend.pages.category.edit', compact('data'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $validated = $request->only(['name','updated_by']);
        // dd($validated);
        $validated['updated_by'] = auth()->user()->id;
        $this->categoryService->update($id, $validated);
        Alert::success(' Berhasil Ubah Data ', ' Silahkan Periksa Kembali');
        return redirect()->route('category.index');
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $category_id = $this->categoryService->delete($request->id);
        return response()->json($category_id);
    }

    public function forceDelete(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $category_id = $this->categoryService->forceDelete($request->id);
        return response()->json($category_id);
    }

    public function trashData(CategoryTrashedDatatable $datatables)
    {
        return $datatables->render('backend.pages.trash.category');
    }

    public function restore($id)
    {
        $this->categoryService->restoreCategory($id);
        return redirect()->back();
    }

    public function restoreAll()
    {
        $this->categoryService->restoreAllCategory();
        return redirect()->back();
    }
}
