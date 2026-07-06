<aside id="adminSidebar">

    {{-- Brand Header --}}
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
        @if(!empty($settings['logo']))
            <img src="@fileUrl($settings['logo'])" alt="{{ $settings['site_name'] ?? 'Logo' }}" style="max-height: 38px; border-radius: 8px;">
        @else
            <div class="brand-icon">
                <i class="fa-solid fa-bolt"></i>
            </div>
        @endif
        <div class="brand-text">
            <span class="brand-title">{{ $settings['site_name'] ?? 'Admin Panel' }}</span>
            <span class="brand-sub">Control Center</span>
        </div>
    </a>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        <div class="nav-section-label">Overview</div>

        <div class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-gauge-high"></i></span>
                Dashboard
            </a>
        </div>

        <div class="nav-section-label">Content Management</div>
        
        <div class="nav-item">
            <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-diagram-project"></i></span>
                Projects
            </a>
        </div>

        <div class="nav-item">
            <a href="{{ route('admin.frontend-manage') }}" class="{{ request()->routeIs('admin.frontend-manage', 'admin.hero-settings.*', 'admin.services-settings.*', 'admin.stats.*', 'admin.services.*', 'admin.plans.*', 'admin.testimonials.*', 'admin.why-choose-uses.*', 'admin.process-steps.*', 'admin.skills.*', 'admin.albums.*', 'admin.social-links.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-laptop-code"></i></span>
                Manage Frontend
            </a>
        </div>

        <div class="nav-section-label">Blog</div>

        <div class="nav-item">
            <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-newspaper"></i></span>
                Blog Posts
            </a>
        </div>
        <div class="nav-item">
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-folder-open"></i></span>
                Categories
            </a>
        </div>

        <div class="nav-section-label">Communication</div>

        <div class="nav-item">
            <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-envelope"></i></span>
                Messages
            </a>
        </div>

        @if(auth()->user()?->isAdmin())
        <div class="nav-section-label">System</div>
        <div class="nav-item">
            <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <span class="nav-icon"><i class="fa-solid fa-gear"></i></span>
                Settings
            </a>
        </div>
        @endif

    </nav>

    {{-- Sidebar Footer --}}
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-100" style="display:flex;align-items:center;gap:12px;padding:9px 14px;border-radius:10px;color:rgba(255,255,255,0.6);background:transparent;border:none;cursor:pointer;font-size:13.5px;font-weight:500;transition:all 0.18s;width:100%;" onmouseover="this.style.background='rgba(239,68,68,0.12)';this.style.color='#f87171'" onmouseout="this.style.background='transparent';this.style.color='rgba(255,255,255,0.6)'">
                <span style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:rgba(239,68,68,0.1);font-size:13px;flex-shrink:0;">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </span>
                Sign Out
            </button>
        </form>
    </div>

</aside>
