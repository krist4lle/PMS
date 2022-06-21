<?php

namespace App\Http\Controllers\Departments;

use App\Http\Controllers\Controller;
use App\Http\Requests\Me\UpdateRequest;
use App\Models\Department;
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
        $departments = Department::all();

        return view('departments.index', [
            'departments' => $departments,
        ]);
    }
}
