<aside class="w-64 bg-gray-800 text-white min-h-screen hidden lg:block">
    <div class="p-4 border-b border-gray-700">
        <h1 class="text-xl font-bold">Admin Panel</h1>
    </div>
    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-gauge" aria-hidden="true"></i> Dashboard
        </a>
        <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.profile.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-user" aria-hidden="true"></i> Profile
        </a>
        <a href="{{ route('admin.social-links.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.social-links.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-share-nodes" aria-hidden="true"></i> Social Links
        </a>
        <a href="{{ route('admin.skills.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.skills.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-code" aria-hidden="true"></i> Skills
        </a>
        <a href="{{ route('admin.projects.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.projects.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-diagram-project" aria-hidden="true"></i> Projects
        </a>
        <a href="{{ route('admin.experiences.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.experiences.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-briefcase" aria-hidden="true"></i> Experience
        </a>
        <a href="{{ route('admin.educations.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.educations.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-graduation-cap" aria-hidden="true"></i> Education
        </a>
        <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.posts.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-newspaper" aria-hidden="true"></i> Blog Posts
        </a>
        <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-folder" aria-hidden="true"></i> Categories
        </a>
        <a href="{{ route('admin.contacts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.contacts.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i> Contacts
        </a>
        @if(auth()->user()?->isAdmin())
        <a href="{{ route('admin.settings.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-700 {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700' : '' }}">
            <i class="fa-solid fa-gear" aria-hidden="true"></i> Settings
        </a>
        @endif
    </nav>
</aside>

<!-- Mobile sidebar -->
<div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 lg:hidden">
    <div class="fixed inset-0 bg-black opacity-50" @click="sidebarOpen = false"></div>
    <aside class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white z-50">
        <div class="p-4 border-b border-gray-700 flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Panel</h1>
            <button @click="sidebarOpen = false" class="text-white">&times;</button>
        </div>
        <nav class="p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-gauge" aria-hidden="true"></i> Dashboard</a>
            <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-user" aria-hidden="true"></i> Profile</a>
            <a href="{{ route('admin.social-links.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-share-nodes" aria-hidden="true"></i> Social Links</a>
            <a href="{{ route('admin.skills.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-code" aria-hidden="true"></i> Skills</a>
            <a href="{{ route('admin.projects.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-diagram-project" aria-hidden="true"></i> Projects</a>
            <a href="{{ route('admin.experiences.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-briefcase" aria-hidden="true"></i> Experience</a>
            <a href="{{ route('admin.educations.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i> Education</a>
            <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-newspaper" aria-hidden="true"></i> Blog Posts</a>
            <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-folder" aria-hidden="true"></i> Categories</a>
            <a href="{{ route('admin.contacts.index') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-envelope" aria-hidden="true"></i> Contacts</a>
            @if(auth()->user()?->isAdmin())
            <a href="{{ route('admin.settings.edit') }}" class="block px-4 py-2 rounded hover:bg-gray-700"><i class="fa-solid fa-gear" aria-hidden="true"></i> Settings</a>
            @endif
        </nav>
    </aside>
</div>
