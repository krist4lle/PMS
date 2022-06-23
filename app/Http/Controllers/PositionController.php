<?php

namespace App\Http\Controllers;

use App\Http\Requests\Position\StoreRequest;
use App\Http\Requests\Position\UpdateRequest;
use App\Models\Position;
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
        return view('positions.create');
    }

    public function store(StoreRequest $request, PositionService $service)
    {
        $positionTitle = $request->validated();
        $service->positionSave(new Position(), $positionTitle['title']);

        return redirect(route('positions.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit(Position $position)
    {
        return view('positions.edit', [
            'position' => $position
        ]);
    }

    public function update(UpdateRequest $request, Position $position, PositionService $service)
    {
        $dataTitle = $request->validated();
        $service->positionSave($position, $dataTitle['title']);

        return redirect(route('positions.index'));
    }

    public function destroy(Position $position, PositionService $service)
    {
        $service->positionDelete($position);

        return redirect(route('positions.index'));
    }
}
