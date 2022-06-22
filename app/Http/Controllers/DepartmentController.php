<?php

namespace App\Http\Controllers;

use App\Http\Requests\Department\UpdateRequest;
use App\Models\Department;
use App\Service\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('users')->get();

        return view('departments.index', [
            'departments' => $departments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(UpdateRequest $request, Department $department, DepartmentService $service)
    {
        $dataName = $request->validated();
        $service->departmentSave($department, $dataName['name']);

        return redirect(route('departments.index'));
    }

    public function destroy(Department $department, DepartmentService $service)
    {
        $service->departmentDelete($department);

        return redirect(route('departments.index'));
    }
}
