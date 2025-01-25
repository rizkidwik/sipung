
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ url('/') }}" class="text-nowrap logo-img">
                <img src="{{ route('configuration.logo') }}" width="100" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                @foreach (getMenus() as $menu)
                    @if ($menu->menu_hassub)
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">{{ $menu->name }}</span>
                        </li>
                    @else
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">{{ $menu->name }}</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ url('backend/' . $menu->url) }}" aria-expanded="false">
                                <span>
                                    <i class="{{ $menu->icon }}"></i>
                                </span>
                                <span class="hide-menu">{{ $menu->name }}</span>
                            </a>
                        </li>
                    @endif
                    @if (isMenuAllowed($menu))
                        @if ($menu->subMenus->isNotEmpty())
                            @foreach ($menu->subMenus as $submenu)
                                @if (isMenuAllowed($submenu))
                                    <li
                                        class="sidebar-item {{ request()->is('backend/' . $submenu->url) ? 'active' : '' }}"">
                                        <a class="sidebar-link" href="{{ url('backend/' . $submenu->url) }}"
                                            aria-expanded="false">
                                            <span>
                                                <i class="{{ $menu->icon }}"></i>
                                            </span>
                                            <span class="hide-menu">{{ $submenu->name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
