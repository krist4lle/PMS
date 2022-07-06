<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IssueResource extends JsonResource
{
    public function toArray($request)
    {
        $this->load(['status', 'assignee'])->orderByDesc('updated_at')->paginate(10);
        $status = $this->status;
        $project = $this->project;
        $assignee = $this->assignee;
        $position = $assignee->position;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'finishedAt' => $this->finished_at,
            'status' => [
                'name' => $status->name,
                'slug' => $status->slug,
            ],
            'project' => [
                'id' => $project->id,
                'title' => $project->title,
            ],
            'assignee' => [
                'id' => $assignee->id,
                'firstName' => $assignee->first_name,
                'lastName' => $assignee->last_name,
                'position' => [
                    'id' => $position->id,
                    'title' => $position->title,
                ],
            ],
        ];
    }
}
