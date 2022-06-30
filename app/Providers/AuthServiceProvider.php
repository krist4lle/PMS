<?php

namespace App\Providers;

use App\Models\Department;
use App\Models\Issue;
use App\Models\Position;
use App\Models\Project;
use App\Models\User;
use App\Policies\DepartmentPolicy;
use App\Policies\IssuePolicy;
use App\Policies\PositionPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Department::class => DepartmentPolicy::class,
        Position::class => PositionPolicy::class,
        User::class => UserPolicy::class,
        Project::class => ProjectPolicy::class,
        Issue::class => IssuePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
