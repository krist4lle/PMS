<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $allEmployees = $this->allEmployees();

        return view('users.index',  $allEmployees);
    }

    public function allEmployees()
    {
        $users = User::with(['position', 'department', 'parent'])->get();
        $ceo = $users->where('position_id', 1)->first();
        $headManagement = $users->where('position_id', 2)->first();
        $artDirector = $users->where('position_id', 3)->first();
        $headFrontend = $users->where('position_id', 4)->first();
        $headBackend = $users->where('position_id', 5)->first();

        return [
            'users' => $users,
            'ceo' => $ceo,
            'headManagement' => $headManagement,
            'artDirector' => $artDirector,
            'headFrontend' => $headFrontend,
            'headBackend' => $headBackend,
        ];
    }
}
