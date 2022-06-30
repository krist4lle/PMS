<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Department;
use App\Models\Issue;
use App\Models\IssueStatus;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Faker\Generator;

class IssueSeeder extends Seeder
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public function run()
    {
        for ($i = 0; $i < 150; $i++) {
            $this->createIssue();
        }
    }

    private function createIssue()
    {
        $issue = new Issue();
        $issue->title = $this->issueTitle();
        $issue->description = $this->faker->realText();
        $status = IssueStatus::where('slug', 'new')->first();
        $issue->status()->associate($status);
        $project = Project::all()->random();
        $issue->project()->associate($project);
        $i = rand(0, 5);
        if ($i === 0) {
            $assignee = $project->manager;
        } else {
            $assignee = $project->users->random();
        }
        $issue->assignee()->associate($assignee);
        $issue->save();
    }

    private function issueTitle(): string
    {
        $titles = [
            'CRUD',
            'Hotfix',
            'Create feature',
            'Edit feature',
            'Show feature',
            'Delete feature',
            'New design',
            'Interface fix',
            'Add Bootstrap',
            'Create Form',
        ];

        return $titles[rand(0, 9)];
    }
}
