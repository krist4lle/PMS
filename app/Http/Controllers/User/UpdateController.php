<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\Service\User\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user, Service $service)
    {
        $data = $request->validated();
        $data = $service->passwordCheck($data);
        $data = $service->avatarUpdate($data, $user);
        $user->update($data);

        return redirect(route('users.show', $user->id));
    }
}
