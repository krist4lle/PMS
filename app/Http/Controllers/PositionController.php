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
        $this->authorize('create', Position::class);
        $departments = Department::all();

        return view('positions.create', [
            'departments' => $departments
        ]);
    }

    public function store(StoreRequest $request, PositionService $service)
    {
        $this->authorize('create', Position::class);
        $positionData = $request->validated();
        $service->positionSave(new Position(), $positionData);

        return redirect(route('positions.index'))->with('success', 'Position successfully created');
    }

    public function edit(Position $position)
    {
        $this->authorize('update', $position);
        $departments = Department::all();
        $position->load('department');

        return view('positions.edit', [
            'position' => $position,
            'departments' => $departments,
        ]);
    }

    public function update(UpdateRequest $request, Position $position, PositionService $service)
    {
        $this->authorize('update', $position);
        $positionData = $request->validated();
        $service->positionSave($position, $positionData);

        return redirect(route('positions.index'))->with('success', 'Position successfully updated');
    }

    public function destroy(Position $position, PositionService $service)
    {
        $this->authorize('delete', $position);
        $service->positionDelete($position);

        return redirect(route('positions.index'))->with('success', 'Position successfully deleted');
    }
}
