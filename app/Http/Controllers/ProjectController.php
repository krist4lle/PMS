<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use App\Service\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['manager', 'users'])->get();

        return view('projects.index', [
            'projects' => $projects
        ]);
    }

    public function create(ProjectService $service)
    {
        return view('projects.create', $service->dataToCreateProject());
    }

    public function store(StoreRequest $request)
    {
        $projectData = $request->validated();
        dd($projectData);
    }

    public function show(Project $project, ProjectService $service)
    {
        return view('projects.show', $service->dataToShowProject($project));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
