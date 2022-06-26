<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\FinishedRequest;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Project;
use App\Service\ProjectService;

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
        $service->createProject(new Project(), $projectData);

        return redirect(route('projects.index'))->with('success', 'Project successfully created');
    }

    public function show(Project $project, ProjectService $service)
    {
        return view('projects.show', $service->dataToShowProject($project));
    }

    public function edit(Project $project, ProjectService $service)
    {
        return view('projects.edit', $service->dataToEditProject($project));
    }

    public function update(UpdateRequest $request, Project $project, ProjectService $service)
    {
        $projectData = $request->validated();
        $service->updateProject($project, $projectData);

        return redirect()->back()->with('success', 'Project successfully edited');
    }

    public function destroy(Project $project)
    {
        if ($project->finished_at === null) {
            return redirect()->back()->with('error', 'Impossible to delete Project in progress');
        } else {
            $project->delete();
            return redirect()->back()->with('success', 'Project successfully deleted');
        }
    }

    public function finished(FinishedRequest $request, Project $project, ProjectService $service)
    {
        $finishedAtDate = $request->validated();
        $service->projectStatus($project, $finishedAtDate['finished_at']);

        return redirect()->back();
    }
}
