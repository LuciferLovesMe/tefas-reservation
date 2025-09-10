@props(['icon', 'title', 'link', 'isActive' => false, 'color' => 'text-blue-500'])

<li class="sidebar-item {{ $isActive ? 'active' : '' }}">
    <a href="{{ $link }}" class='sidebar-link'>
        <i class="{{ $icon }}"></i>
        <span>{{ $title }}</span>
    </a>
</li>
