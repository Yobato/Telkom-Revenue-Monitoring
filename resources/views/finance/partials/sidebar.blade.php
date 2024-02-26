<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html" class="logo d-flex align-items-center justify-content-center">
                {{-- <img src="{{ asset('favicon.ico') }}" alt=""> --}}
                <span class="d-none d-lg-block">Telkom Akses</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <img src="{{ asset('favicon.ico') }}" alt="">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $title==='KKP' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-bar-chart-fill"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $title==='KKP' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('finance.dashboard.chart') }}">KKP Operasional</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $title==='Laporan Finance' || $title==='Laporan Nota' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-pie-chart-fill"></i><span>Pelaporan</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ $title===' Laporan Finance' ? ' active' : '' }}'>
                        <a class="nav-link" href="{{ route('finance.dashboard.index') }}">PID Finance</a>
                    </li>
                    <li class='{{ $title===' Laporan Nota' ? ' active' : '' }}'>
                        <a class="nav-link" href="{{ route('nota.dashboard.index') }}">Laporan Nota</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>