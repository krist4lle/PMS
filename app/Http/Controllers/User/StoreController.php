<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use App\Service\User\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, Service $service)
    {
        $data = $request->validated();
        $data = $service->avatarSave($data);
        $service->userCreate($service->dataAsigning($data));
        return redirect(route('users.index'));
    }
}
