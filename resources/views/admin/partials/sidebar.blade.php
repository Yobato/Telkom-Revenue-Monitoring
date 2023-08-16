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
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="bi bi-bar-chart-fill"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('admin-gpm') }}">Gross Profit Margin</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('admin-cogs') }}">Cost of Goods Sold</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('admin-revenue') }}">Revenue</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'admin.dashboard' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('admin-kkp') }}">KKP Operasional</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $title==='Laporan Finance' || $title==='Laporan Commerce' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="bi bi-pie-chart-fill"></i><span>Reporting</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $title==='Laporan Commerce' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.commerce')}}">COGS & Revenue</a>
                    </li>
                    <li class="{{ $title==='Laporan Finance' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.finance')}}">KKP Operasional</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{  $title ==='City'|| $title==='Cost Plan'|| $title==='Program'|| $title==='Portofolio'|| $title==='Peruntukan' || $title==='User Reco' || $title==='Role' || $title==='SubGrupAkun' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="bi bi-menu-button-fill"></i><span>Dropdown</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ $title==='City' ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard.city')}}">City</a>
                    </li>
                    <li class="{{ $title==='Cost Plan' ? ' active' : '' }}">
                        <a class="nav-link"
                        href="{{ route('admin.dashboard.cost_plan')}}">Cost Plan</a>
                    </li>
                    <li class="{{ $title==='Program' ? ' active' : '' }}">
                        <a class="nav-link"
                        href="{{ route('admin.dashboard.program')}}">Program</a>
                    </li>
                    <li class="{{ $title==='Portofolio' ? ' active' : '' }}">
                        <a class="nav-link"
                        href="{{ route('admin.dashboard.portofolio')}}">Portofolio</a>
                    </li>
                    <li class="{{ $title==='Peruntukan' ? ' active' : '' }}">
                        <a class="nav-link"
                        href="{{ route('admin.dashboard.peruntukan')}}">Peruntukan</a>
                    </li>
                    <li class='{{ $title==='Role' ? ' active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('admin.dashboard.role')}}">Role</a>
                    </li>
                    <li class='{{ $title==='SubGrupAkun' ? ' active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('admin.dashboard.sub')}}">Sub Grup Akun</a>
                    </li>
                    <li class="{{ $title==='User Reco' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('admin.dashboard.user_reco')}}">User</a>
                    </li>
                </ul>
            </li>
            <li class="{{ $title==='Account' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.account')}}"><i class="bi bi-people-fill"></i><span>User Management</span></a></li>
            <li class="{{ $title==='Target' ? ' active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard.target')}}"><i class="bi bi-ui-checks"></i><span>Target Management</span></a></li>
        </ul>
    </aside>
</div>
