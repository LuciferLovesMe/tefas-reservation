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
                @if (auth()->user()->role === 'admin')
                <li class="sidebar-title">Master Data</li>
                <x-sidebar-item icon="bi bi-layout-text-sidebar-reverse" title="Dashboard" link="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')" />
                <x-sidebar-item icon="bi bi-tools" title="Teaching Factory" link="{{ route('tefa.index') }}" :isActive="request()->routeIs(['tefa.index', 'tefa.create', 'tefa.edit'])" />
                <x-sidebar-item icon="bi bi-door-open-fill" title="Ruangan" link="{{ route('ruangan.index') }}" :isActive="request()->routeIs(['ruangan.index', 'ruangan.create', 'ruangan.edit'])" />
                @endif
                <li class="sidebar-title">Reservasi</li>
                <x-sidebar-item icon="bi bi-calendar-check-fill" title="Reservasi" link="{{ route('reservasi.index') }}" :isActive="request()->routeIs(['reservasi.index', 'reservasi.create', 'reservasi.edit'])" />
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
