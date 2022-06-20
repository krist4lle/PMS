<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke()
    {
        $data = $this->dataForUser();

        return view('users.create', $data);
    }

    /**
     * @return array
     */
    public function dataForUser(): array
    {
        $positions = Position::all();
        $departments = Department::all();
        $supervisors = User::query()
            ->where('parent_id', '<', 2)
            ->orWhereNull('parent_id')
            ->get();
        return [
            'positions' => $positions,
            'departments' => $departments,
            'supervisors' => $supervisors,
        ];
    }
}
