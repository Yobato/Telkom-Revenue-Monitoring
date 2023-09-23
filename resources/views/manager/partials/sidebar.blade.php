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
            <li
                class="nav-item dropdown {{ $title==='KKP' || $title==='Revenue' || $title==='COGS'|| $title==='GPM' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-bar-chart-fill"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $title==='GPM' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('manager.dashboard') }}">Gross Profit Margin</a>
                    </li>
                    <li class="{{ $title==='COGS' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('manager-cogs') }}">Cost of Goods Sold</a>
                    </li>
                    <li class="{{ $title==='Revenue' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('manager-revenue') }}">Revenue</a>
                    </li>
                    <li class="{{ $title==='KKP' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('manager-kkp') }}">KKP Operasional</a>
                    </li>
                </ul>
            </li>
            <li
                class="nav-item dropdown {{ $title==='Laporan Finance' || $title==='Laporan Commerce' || $title==='Laporan Nota' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-pie-chart-fill"></i><span>Reporting</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $title==='Laporan Commerce' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('manager.dashboard.commerce')}}">COGS & Revenue</a>
                    </li>
                    <li class="{{ $title==='Laporan Finance' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('manager.dashboard.finance')}}">PID Finance</a>
                    </li>
                    <li class="{{ $title==='Laporan Nota' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('manager.dashboard.nota')}}">Laporan Nota</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $title==='Target' || $title==='Target-Finance' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-ui-checks"></i><span>Target
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $title==='Target' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('manager.dashboard.target')}}">Target Commerce</a>
                    </li>
                    <li class="{{ $title==='Target-Finance' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('manager.dashboard.target-finance')}}">Target Finance</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="{{ $title==='Target' ? ' active' : '' }}"><a class="nav-link"
                    href="{{route('manager.dashboard.target')}}"><i class="bi bi-ui-checks"></i><span>Target</span></a>
            </li> --}}
        </ul>
    </aside>
</div>