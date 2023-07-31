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
                    <li class='{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('manager-gpm') }}">Gross Profit Margin</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="#">Cost of Goods Sold</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="#">Revenue</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="#">KKP Operasional</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="bi bi-people-fill"></i><span>User Management</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item ">
                        <a href="{{ route('commerce-management') }}"
                            class="nav-link "><span>Commerce</span></a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}">
                        <a href="{{ route('finance-management') }}"
                            class="nav-link "><span>Finance</span></a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}">
                        <a href="{{ route('gm-management') }}"
                            class="nav-link "><span>General Manager</span></a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="bi bi-ui-checks"></i><span>Target Management</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}'>
                        <a class="nav-link"
                            href="#">Cost of Goods Sold</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="#">Revenue</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="#">KKP Operasional</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#"
                    class="nav-link has-dropdown"><i class="bi bi-pie-chart-fill"></i><span>Reporting</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}'>
                        <a class="nav-link"
                            href="#">COGS & Revenue</a>
                    </li>
                    <li class="{{ Request::route()->getName() == 'manager.dashboard' ? ' active' : '' }}">
                        <a class="nav-link"
                            href="#">KKP Operasional</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
