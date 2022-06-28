<!-- Home -->
<li class="nav-item">
    <a href="{{ route('index') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<!-- Our Team -->
<li class="nav-item">
    <a href="{{ route('employees.index') }}" class="nav-link {{ Request::is('employees') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Our Team</p>
    </a>
</li>
<!-- My Issues -->
<li class="nav-item">
    <a href="{{ route('me.issues', auth()->user()) }}" class="nav-link {{ Request::is('my-issues') ? 'active' : '' }}">
        <i class="nav-icon fas fa-clipboard-list"></i>
        <p>My Issues</p>
        <span class="badge badge-warning">{{ auth()->user()->issues->count() }}</span>
    </a>
</li>
<!-- Departments -->
<li class="nav-item">
    <a href="{{ route('departments.index') }}" class="nav-link {{ Request::is('departments') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users-cog"></i>
        <p>Departments</p>
    </a>
</li>
<!-- Positions -->
<li class="nav-item">
    <a href="{{ route('positions.index') }}" class="nav-link {{ Request::is('positions') ? 'active' : '' }}">
        <i class="nav-icon fas fa-briefcase"></i>
        <p>Positions</p>
    </a>
</li>
<!-- Users -->
    <li class="nav-item">
        <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users') ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-edit"></i>
            <p>Users</p>
        </a>
    </li>
<!-- Projects -->
<li class="nav-item">
    <a href="{{ route('projects.index') }}" class="nav-link {{ Request::is('projects') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Projects</p>
    </a>
</li>
<!-- Clients -->
<li class="nav-item">
    <a href="{{ route('clients.index') }}" class="nav-link {{ Request::is('clients') ? 'active' : '' }}">
        <i class="nav-icon fas fa-people-arrows"></i>
        <p>Clients</p>
    </a>
</li>
