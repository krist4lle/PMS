<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Department;
use App\Models\IssueStatus;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Faker\Generator;
use Illuminate\Support\Str;

class IssueStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            'NEW',
            'IN PROGRESS',
            'REVIEW',
            'DONE',
        ];

        foreach ($statuses as $status) {
            $issueStatus = new IssueStatus();
            $issueStatus->name = $status;
            $issueStatus->slug = Str::slug($status, '_');
            $issueStatus->save();
        }
    }
}
