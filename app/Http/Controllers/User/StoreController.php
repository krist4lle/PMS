<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data = $this->passwordCheck($data);
        $data = $this->avatarSave($data);
        $user->update($data);

        return redirect(route('users.show', $user->id));
    }

    public function passwordCheck($data)
    {
        if ($data['password'] !== null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }

    public function avatarSave($data)
    {
        $data['avatar'] = Storage::disk('local')->put('avatars', $data['avatar']);

        return $data;
    }
}
