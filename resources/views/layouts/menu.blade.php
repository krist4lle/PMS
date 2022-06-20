<!-- Home -->
<li class="nav-item">
    <a href="{{ route('index') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<!-- Employees -->
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>
            Employees
            <i class="fas fa-angle-left right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Our Team</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('users.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Employee</p>
            </a>
        </li>
    </ul>
</li>
