<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html" class="logo d-flex align-items-center">
                <img src="{{ asset('favicon.ico') }}" alt="">
                <span class="d-none d-lg-block">Telkom Akses</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
          <img src="{{ asset('favicon.ico') }}" alt="">
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $title==='Dashboard Finance' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-bar-chart-fill"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $title==='Dashboard Finance' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('finance.dashboard.chart') }}">KKP Operasional</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $title==='Laporan Finance' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-pie-chart-fill"></i><span>Reporting</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ $title==='Laporan Finance' ? ' active' : '' }}'>
                        <a class="nav-link" href="{{ route('finance.dashboard.index') }}">Laporan KKP</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
