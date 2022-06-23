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
