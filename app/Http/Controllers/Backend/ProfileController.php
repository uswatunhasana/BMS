<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Modules\Services\UserService;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    protected UserService $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }
    
    public function edit($id)
    {
        $data = $this->userService->getUserById($id);
        return view('backend.pages.profile.edit', compact('data'));
    }

    public function update(ProfileRequest $request)
    {
        $this->userService->update(auth()->user()->id, $request->only('name','email'));
        Alert::success(' Berhasil Update Data ', ' Silahkan dicek kembali');
        return redirect()->back();
    }

    public function password(PasswordRequest $request)
    {
        if (auth()->user()->id == 1) {
            return back()->withErrors(['not_allow_password' => __('You are not allowed to change the password for Superadmin.')]);
        }
        $this->userService->update(auth()->user()->id, $request->only('password'));
        Alert::success('Passsword Berhasil Diubah', ' Silahkan dicek kembali');
        return redirect()->back();
    }
}
