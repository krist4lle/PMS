<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Models\Project;
use App\Service\ProjectService;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['manager', 'users'])->withCount('issues')
            ->orderByDesc('updated_at')->paginate(10);

        return view('projects.index', [
            'projects' => $projects
        ]);
    }

    public function create(ProjectService $service)
    {
        $this->authorize('create', Project::class);

        return view('projects.create', $service->prepareDataToCreateProject());
    }

    public function store(StoreRequest $request, ProjectService $service)
    {
        $this->authorize('create', Project::class);
        $projectData = $request->validated();
        $service->createProject(new Project(), $projectData);

        return redirect(route('projects.index'))->with('success', 'Project successfully created');
    }

    public function show(Project $project, ProjectService $service)
    {
        return view('projects.show', $service->prepareDataToShowProject($project));
    }

    public function edit(Project $project, ProjectService $service)
    {
        $this->authorize('update', $project);

        return view('projects.edit', $service->prepareDataToEditProject($project));
    }

    public function update(UpdateRequest $request, Project $project, ProjectService $service)
    {
        $this->authorize('update', $project);
        $projectData = $request->validated();
        $service->updateProject($project, $projectData);

        return redirect()->back()->with('success', 'Project successfully edited');
    }

    public function destroy(Project $project)
    {
        if ($project->finished_at === null) {

            return redirect()->back()->with('error', 'Impossible to delete Project in progress');
        }
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project successfully deleted');

    }

    public function status(Project $project, ProjectService $service)
    {
        $service->projectStatusChange($project);

        return redirect()->back();
    }
}
