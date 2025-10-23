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
                <li class="sidebar-title">Dashboard</li>
                <x-sidebar-item icon="bi bi-grid-fill" title="Dashboard" link="{{ route('dashboard') }}" :isActive="request()->routeIs('dashboard')" />
                @if (auth()->user()->role === 'admin')
                <li class="sidebar-title">Master Data</li>
                <x-sidebar-item icon="bi bi-list-task" title="Aktivitas" link="{{ route('aktivitas.index') }}" :isActive="request()->routeIs(['aktivitas.index', 'aktivitas.create', 'jenis-kunjungan.edit'])" />
                <x-sidebar-item icon="bi bi-bullseye" title="Capaian Pembelajaran" link="{{ route('capaian-pembelajaran.index') }}" :isActive="request()->routeIs(['capaian-pembelajaran.index', 'capaian-pembelajaran.create', 'capaian-pembelajaran.edit'])" />
                <x-sidebar-item icon="bi bi-tags-fill" title="Jenis Kunjungan" link="{{ route('jenis-kunjungan.index') }}" :isActive="request()->routeIs(['jenis-kunjungan.index', 'jenis-kunjungan.create', 'jenis-kunjungan.edit'])" />
                <x-sidebar-item icon="bi bi-tools" title="Teaching Factory" link="{{ route('tefa.index') }}" :isActive="request()->routeIs(['tefa.index', 'tefa.create', 'tefa.edit'])" />
                <x-sidebar-item icon="bi bi-gear-fill" title="Aturan Rekomendasi" link="{{ route('rule.index') }}" :isActive="request()->routeIs(['rule.index', 'rule.create', 'rule.edit'])" />
                {{-- <x-sidebar-item icon="bi bi-door-open-fill" title="Ruangan" link="{{ route('ruangan.index') }}" :isActive="request()->routeIs(['ruangan.index', 'ruangan.create', 'ruangan.edit'])" /> --}}
                @endif
                <li class="sidebar-title">Reservasi</li>
                <x-sidebar-item icon="bi bi-calendar-check-fill" title="Reservasi" link="{{ route('reservasi.index') }}" :isActive="request()->routeIs(['reservasi.index', 'reservasi.create', 'reservasi.edit'])" />
                <li class="sidebar-title">Akun</li>
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class='sidebar-link' onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
