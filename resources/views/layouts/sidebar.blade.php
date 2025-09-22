<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <x-sidebar-item icon="bi bi-grid-fill" title="Dashboard" link="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')" />
                    <x-sidebar-item icon="bi bi-grid-fill" title="Teaching Factory" link="{{ route('tefa.index') }}" :isActive="request()->routeIs('tefa')" />
                <x-sidebar-item icon="bi bi-grid-fill" title="Ruangan" link="{{ route('ruangan.index') }}" :isActive="request()->routeIs('ruangan')" />
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
