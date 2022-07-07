<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        $manager = $this->manager;
        $client = $this->client;
        if (!empty($this->issues)) {
            $issues = IssueResource::collection($this->issues);
        }
        $users = [];
        foreach ($this->users as $i => $user) {
            $users["user{$i}"] = [
                'id' => $user->id,
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,
                'position' => [
                    'id' => $user->position->id,
                    'title' => $user->position->title,
                ],
            ];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'client' => [
                'id' => $client->id,
                'title' => $client->title,
            ],
            'manager' => [
                'id' => $manager->id,
                'firstName' => $manager->first_name,
                'lastName' => $manager->last_name,
                'position' => [
                    'id' => $manager->position->id,
                    'title' => $manager->position->title,
                ],
            ],
            'users' => $users,
            'deadline' => $this->deadline,
            'finishedAt' => $this->finished_at,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'issuesCount' => $this->issues_count,
            'issues' => $issues,
        ];
    }
}
