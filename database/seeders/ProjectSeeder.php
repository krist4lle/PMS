<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Department;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Faker\Generator;

class ProjectSeeder extends Seeder
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public function run()
    {
        for ($i = 0; $i < 13; $i++) {
            $this->createProject();
        }
    }

    private function createProject(): void
    {
        $project = new Project();
        $project->title = $this->faker->unique()->jobTitle;
        $project->description = $this->faker->realText();
        $this->client($project);
        $this->manager($project);
        $project->deadline = $this->deadline();
        $project->save();
        $this->users($project);
    }

    private function client(Project $project): void
    {
        $client = Client::all()->random();
        $project->client()->associate($client);
    }

    private function manager(Project $project): void
    {
        $manager = User::whereRelation('department', 'name', 'Management')->get()->random();
        $project->manager()->associate($manager);
    }

    private function deadline(): string
    {
        $date = rand(2022, 2024) . '-' . rand(1, 12) . '-' . rand(1, 30);
        return date_format(date_create($date), 'Y-m-d');
    }

    private function users(Project $project): void
    {
        $usersDesign = User::whereRelation('department', 'name', '=', 'Design')->get()->random(rand(1, 2));
        $usersFrontend = User::whereRelation('department', 'name', '=', 'Frontend')->get()->random(rand(1, 3));
        $usersBackend = User::whereRelation('department', 'name', '=', 'Backend')->get()->random(rand(1, 3));
        $workers = $usersDesign->merge($usersFrontend)->merge($usersBackend);
        $project->users()->attach($workers);
    }
}
