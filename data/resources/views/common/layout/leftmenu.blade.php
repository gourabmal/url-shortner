@php
    $info = \App\Helper\admin\siteInformation::siteInfo();
    $currentUrl = url()->current();
    $segment4 = Request::segment(4);
    $segment5 = Request::segment(5);
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:void(0)" class="brand-link d-flex justify-content-center align-items-center">
        @if (!empty($info['site_logo']))
            <img src="{{ asset('data/public/uploads/info/' . $info['site_logo']) }}" alt="{{ $info['site_name'] }}"
                style="max-height:40px; width:auto; object-fit:contain;">
        @else
            <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
        @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ $dashboardRoute }}"
                        class="nav-link {{ $currentUrl == $dashboardRoute ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Invitations -->
                @unlessrole('Member')
                    <li class="nav-item">
                        <a href="{{ $invitationRoute }}"
                            class="nav-link {{ Str::startsWith($currentUrl, $invitationRoute) ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope-open-text"></i>
                            <p>Invitations</p>
                        </a>
                    </li>
                @endunlessrole

                <!-- Short URLs -->
                <li class="nav-item">
                    <a href="{{ $shortUrlRoute }}"
                        class="nav-link {{ Str::startsWith($currentUrl, $shortUrlRoute) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-link"></i>
                        <p>Short URLs</p>
                    </a>
                </li>


                <!-- Site Settings -->
                @role('SuperAdmin')
                    <li class="nav-item">
                        <a href="{{ route('superadmin.information') }}"
                            class="nav-link {{ Request::routeIs('superadmin.information*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Site Settings</p>
                        </a>
                    </li>
                @endrole

            </ul>
        </nav>
    </div>
</aside>
