@foreach($globalMenuItems as $menuItem)
    <li class="nav-item">
        <a href="{{ $menuItem->url }}" class="nav-link {{ Request::is($menuItem->routeGroup) ? 'active' : '' }}">
            <i class="nav-icon fas {{ $menuItem->iconClass }}"></i>
            <p>{{ $menuItem->name }}</p>
            @if(!empty($menuItem->badge))
                <span class="badge badge-{{ $menuItem->badge->type }}">{{ $menuItem->badge->text }}</span>
            @endif
        </a>
    </li>
@endforeach
<li class="nav-item">
    <a href="{{ route('me.projects', auth()->user()) }}" class="nav-link {{ Request::is() ? 'active' : '' }}">
        <i class="nav-icon fas fa-arrows"></i>
        <p>My projects</p>
    </a>
</li>
