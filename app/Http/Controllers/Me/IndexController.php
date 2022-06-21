<?php

namespace App\Http\Controllers\Me;

use App\Http\Controllers\Controller;
use App\Http\Requests\Me\UpdateRequest;
use App\Models\User;
use App\Service\Me\MeService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{
    public function index()
    {
        return view('me.index');
    }

    public function update(UpdateRequest $request, MeService $service)
    {
        $userChanges = $request->validated();
        $userChanges = $service->nullCheck($userChanges);

        if (isset($userChanges['password'])) {
            $userChanges['password'] = $service->passwordHash($userChanges['password']);
        }

        if (isset($userChanges['avatar'])) {
            $userChanges['avatar'] = $service->avatarUpdate($userChanges['avatar']);
        }

        auth()->user()->update($userChanges);

        return redirect(route('me.index'));
    }
}
