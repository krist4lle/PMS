<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class GlobalNavigationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.menu', function ($view) {
            $globalMenuItems = collect([
                (object)[
                    'name' => 'Home',
                    'url' => route('index'),
                    'iconClass' => 'fa-home',
                    'routeGroup' => 'home',
                ],
                (object)[
                    'name' => 'Our Team',
                    'url' => route('employees.index'),
                    'iconClass' => 'fa-users',
                    'routeGroup' => 'employees',
                ],
                (object)[
                    'name' => 'My Issues',
                    'url' => route('me.issues'),
                    'iconClass' => 'fa-clipboard-list',
                    'routeGroup' => 'my-issues',
                    'badge' => (object)[
                        'type' => 'warning',
                        'text' => auth()->user()->issues->count(),
                    ],
                ],
                (object)[
                    'name' => 'My projects',
                    'url' => route('me.projects'),
                    'iconClass' => 'fa-project-diagram',
                    'routeGroup' => 'my-projects',
                    'badge' => (object)[
                        'type' => 'warning',
                        'text' => auth()->user()->projects->isEmpty()
                            ? auth()->user()->managerProjects->count()
                            : auth()->user()->projects->count(),
                    ],
                ],
                (object)[
                    'name' => 'Departments',
                    'url' => route('departments.index'),
                    'iconClass' => 'fa-users-cog',
                    'routeGroup' => 'departments',
                ],
                (object)[
                    'name' => 'Positions',
                    'url' => route('positions.index'),
                    'iconClass' => 'fa-briefcase',
                    'routeGroup' => 'positions',
                ],
                (object)[
                    'name' => 'Users',
                    'url' => route('users.index'),
                    'iconClass' => 'fa-user-edit',
                    'routeGroup' => 'users',
                ],
                (object)[
                    'name' => 'Projects',
                    'url' => route('projects.index'),
                    'iconClass' => 'fa-list',
                    'routeGroup' => 'projects',
                ],
                (object)[
                    'name' => 'Clients',
                    'url' => route('clients.index'),
                    'iconClass' => 'fa-people-arrows',
                    'routeGroup' => 'clients',
                ],
            ]);
            $view->with('globalMenuItems', $globalMenuItems);
        });
    }
}
