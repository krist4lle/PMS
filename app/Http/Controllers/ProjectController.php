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
        $projects = Project::with(['manager', 'users'])->paginate(10);

        return view('projects.index', [
            'projects' => $projects
        ]);
    }

    public function create(ProjectService $service)
    {
        return view('projects.create', $service->dataToCreateProject());
    }

    public function store(StoreRequest $request, ProjectService $service)
    {
        $projectData = $request->validated();
        $service->createProject($projectData);

        return redirect(route('projects.index'))->with('success', 'Project successfully created');
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
