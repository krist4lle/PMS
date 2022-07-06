<?php

namespace App\Http\Controllers\API;

use App\Exceptions\ProjectHasIssuesException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Service\ProjectService;

class ProjectController extends Controller
{
    public function index()
    {
        $page = request()->json()->get('page') ?? 1;
        $perPage = request()->json()->get('per_page') ?? 10;
        $projects = Project::with(['manager', 'users'])->withCount(['issues', 'users'])
            ->orderByDesc('updated_at')->paginate($perPage, ['*'], 'page', $page);

        return ProjectResource::collection($projects);
    }

    public function store(StoreRequest $request, ProjectService $service)
    {
        //$this->authorize('create', Project::class);
        $data = $request->validated();
        $project = $service->createProject(new Project(), $data);

        return new ProjectResource($project);
    }

    public function show(Project $project)
    {
        $project->load(['users', 'issues'])->loadCount('issues');

        return new ProjectResource($project);
    }

    public function update(UpdateRequest $request, Project $project, ProjectService $service)
    {
        $this->authorize('update', $project);
        $projectData = $request->validated();
        $service->updateProject($project, $projectData);

        return new ProjectResource($project);
    }

    public function status(Project $project, ProjectService $service)
    {
        $this->authorize('update', $project);
        try {
            $service->projectStatusChange($project);
        } catch (ProjectHasIssuesException $exception) {

            return response()->json([
                'error' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                ],
            ], 400);
        }

        return new ProjectResource($project);
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $id = $project->id;
        if ($project->finished_at === null) {

            return response()->json([
                'error' => 'Project is not closed',
            ]);
        }
        $project->delete();

        return response()->json([
            'success' => "Project #{$id} delete successfully",
        ]);

    }
}
