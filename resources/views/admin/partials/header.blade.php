<header id="adminTopbar">

    {{-- Mobile hamburger --}}
    <button class="topbar-toggle" id="sidebarToggle" onclick="openSidebar()" aria-label="Open sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>

    {{-- Page title / brand --}}
    <div class="topbar-brand">
        {!! html_entity_decode($__env->yieldContent('page_title', '<span>Admin</span> Panel')) !!}
    </div>

    {{-- Right actions --}}
    <div class="topbar-actions">

        {{-- User Dropdown --}}
        <div class="user-dropdown-wrapper" id="userDropdownWrapper">

            {{-- Trigger Pill --}}
            <button class="topbar-user-pill" id="userDropdownTrigger" onclick="toggleUserDropdown()" aria-haspopup="true" aria-expanded="false" aria-label="User menu" style="border:none;cursor:pointer;background:#f8fafc;">
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                </div>
                <span class="user-name d-none d-md-inline">{{ auth()->user()?->name ?? 'Guest' }}</span>
                <i class="fa-solid fa-chevron-down" id="userDropdownCaret" style="font-size:10px;color:#94a3b8;margin-left:2px;transition:transform 0.2s;"></i>
            </button>

            {{-- Dropdown Panel --}}
            <div class="user-dropdown-panel" id="userDropdownPanel" role="menu" aria-hidden="true">

                {{-- User Info --}}
                <div class="user-dropdown-info">
                    <div class="user-dropdown-avatar">
                        {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="user-dropdown-name">{{ auth()->user()?->name ?? 'Guest' }}</p>
                        <p class="user-dropdown-email">{{ auth()->user()?->email ?? '' }}</p>
                    </div>
                </div>

                <div class="user-dropdown-divider"></div>

                {{-- Menu Items --}}
                <a href="{{ route('admin.profile.edit') }}" class="user-dropdown-item" role="menuitem">
                    <span class="user-dropdown-item-icon"><i class="fa-solid fa-user"></i></span>
                    My Profile
                </a>

                @can('manage-settings')
                <a href="{{ route('admin.settings.edit') }}" class="user-dropdown-item" role="menuitem">
                    <span class="user-dropdown-item-icon"><i class="fa-solid fa-gear"></i></span>
                    Site Settings
                </a>
                @endcan

                <a href="{{ route('home') }}" target="_blank" class="user-dropdown-item" role="menuitem">
                    <span class="user-dropdown-item-icon"><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                    View Site
                </a>

                <div class="user-dropdown-divider"></div>

                {{-- Logout --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="user-dropdown-item user-dropdown-logout" role="menuitem" style="width:100%;border:none;background:none;text-align:left;cursor:pointer;">
                        <span class="user-dropdown-item-icon" style="background:#fef2f2;color:#ef4444;"><i class="fa-solid fa-right-from-bracket"></i></span>
                        Sign Out
                    </button>
                </form>

            </div>
        </div>

    </div>{{-- /.topbar-actions --}}
</header>
