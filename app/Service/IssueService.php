<?php

namespace App\Service;

use App\Models\Client;
use App\Models\Department;
use App\Models\Issue;
use App\Models\IssueStatus;
use App\Models\Position;
use App\Models\Project;
use App\Models\User;

class IssueService
{
    public function createIssue(array $issueData)
    {
        $issue = new Issue();
        $issue->title = $issueData['title'];
        $issue->description = $issueData['description'];
        $status = IssueStatus::where('title', 'new')->first();
        $issue->status()->associate($status);
    }
}
