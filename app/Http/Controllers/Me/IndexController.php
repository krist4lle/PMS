<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Http\Requests\Me\UpdatePasswordRequest;
use App\Http\Requests\Me\UpdateRequest;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('me.index', [
            'user' => $user,
        ]);
    }

    public function update(UpdateRequest $request, UserService $service)
    {
        $user = $request->user();
        $userData = $request->validated();
        $service->updateUser($user, $userData);

        return redirect(route('me.index'));
    }

    public function changePassword(UpdatePasswordRequest $request, UserService $service)
    {
        $user = $request->user();
        $newPassword = $request->validated('password');
        $service->changePassword($user, $newPassword);

        return redirect(route('me.index'))->with('successMessage', 'Password changed successfully');
    }
}
