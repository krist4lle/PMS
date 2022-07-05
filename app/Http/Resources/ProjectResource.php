<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        $manager = $this->manager;
        $users = $this->users;
        $usersArray = [];
        foreach ($users as $i => $user) {
            $usersArray["user{$i}"] = [
                'id' => $user->id,
                'firstName' => $user->first_name,
                'lastName' => $user->last_name,

            ];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'manager' => [
                'id' => $manager->id,
                'firstName' => $manager->first_name,
                'lastName' => $manager->last_name,
            ],
            'users' => $usersArray,
            'finishedAt' => $this->finished_at,
            'createdAt' => $this->created_at,
            'issuesCount' => $this->issues_count,

        ];
    }
}
