
<li class="nav-item">
    <a href="{{ route('index') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Team</p>
    </a>
</li>
