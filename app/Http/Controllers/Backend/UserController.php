<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Modules\Services\UserService;
use App\DataTables\UsersDataTable;
use App\DataTables\UserTrashedDatatable;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Enums\UserType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
        $arrayStatus = Arr::except(UserType::arrayStatus(), ['Superadmin']);
        View::share('arrUserType', $arrayStatus);
    }

    public function index(UsersDataTable $datatables)
    {
        return $datatables->render('backend.pages.user.index');
    }

    public function store(UserPostRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $this->userService->storeUser($validated);
        Alert::success(' Berhasil Tambah Data ', ' Silahkan Periksa Kembali');
        return redirect()->route('users.index');
    }

    public function create()
    {
        return view('backend.pages.user.create');
    }

    public function edit($id)
    {
        $data = $this->userService->getUserById($id);
        return view('backend.pages.user.edit', compact('data'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $this->userService->getUserById($id);
        $validated = $request->validated();
        $validated['updated_by'] = auth()->user()->id;
        if($validated['password'] == '') {
            $validated['password'] = $data->password;
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }
        if(auth()->user()->role == 1) {
            $validated['role'] = $data->role;
        }
        $this->userService->update($id, $validated);
        Alert::success(' Berhasil Ubah Data ', ' Silahkan Periksa Kembali');
        return redirect()->route('users.index');
    }

    public function destroy(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $user_id = $this->userService->delete($request->id);
        return response()->json($user_id);
    }
    
    public function forceDelete(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $user_id = $this->userService->forceDelete($request->id);
        return response()->json($user_id);
    }

    public function trashData(UserTrashedDatatable $datatables)
    {
        return $datatables->render('backend.pages.trash.user');
    }

    public function restore(Request $request)
    {
        if (!$request->ajax()) {
            abort(404);
        }
        $user_id = $this->userService->restoreUser($request->id);
        return response()->json($user_id);
    }

    public function restoreAll()
    {
        $this->userService->restoreAllUser();
        return redirect()->back();
    }
}
