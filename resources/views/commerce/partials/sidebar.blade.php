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
            <li class="nav-item dropdown {{ $title==='Revenue' || $title==='GPM' || $title==='COGS' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-bar-chart-fill"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $title==='GPM' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('commerce.dashboard.gpm') }}">Gross Profit Margin</a>
                    </li>
                    <li class="{{ $title==='COGS' ? ' active' : ''}}">
                        <a class="nav-link" href="{{ route('commerce.dashboard.cogs') }}">Cost of Goods Sold</a>
                    </li>
                    <li class="{{ $title==='Revenue' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('commerce.dashboard.revenue') }}">Revenue</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $title==='Laporan Commerce' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-pie-chart-fill"></i><span>Pelaporan</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ $title===' Laporan Commerce' ? ' active' : '' }}'>
                        <a class="nav-link" href="{{ route('commerce.dashboard.index') }}">COGS & Revenue</a>
                    </li>

                </ul>
            </li>
        </ul>
    </aside>
</div>