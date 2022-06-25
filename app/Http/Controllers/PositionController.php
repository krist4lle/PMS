<?php

namespace App\Http\Controllers;

use App\Http\Requests\Position\StoreRequest;
use App\Http\Requests\Position\UpdateRequest;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use App\Service\PositionService;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::withCount('users')->get();

        return view('positions.index', [
            'positions' => $positions,
        ]);
    }

    public function create()
    {
        $departments = Department::all();

        return view('positions.create', [
            'departments' => $departments
        ]);
    }

    public function store(StoreRequest $request, PositionService $service)
    {
        $positionData = $request->validated();
        $service->positionSave(new Position(), $positionData);

        return redirect(route('positions.index'))->with('success', 'Position successfully created');
    }

    public function show($id)
    {
        //
    }

    public function edit(Position $position)
    {
        $departments = Department::all();

        return view('positions.edit', [
            'position' => $position,
            'departments' => $departments,
        ]);
    }

    public function update(UpdateRequest $request, Position $position, PositionService $service)
    {
        $positionData = $request->validated();
        $service->positionSave($position, $positionData);

        return redirect(route('positions.index'))->with('success', 'Position successfully updated');
    }

    public function destroy(Position $position, PositionService $service)
    {
        $service->positionDelete($position);

        return redirect(route('positions.index'))->with('success', 'Position successfully deleted');
    }
}
