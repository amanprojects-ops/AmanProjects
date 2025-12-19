<header class="bg-white shadow-sm border-b">
    <div class="flex items-center justify-end px-6 py-4">
        <button @click="sidebarOpen = true" class="lg:hidden text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <div class="flex items-center space-x-4">
            <a href="{{ route('home') }}" target="_blank" class="text-gray-600 hover:text-gray-900">View Site</a>
            <span class="text-gray-600">{{ auth()->user()?->name ?? 'Guest' }}</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-red-600 hover:text-red-800">Logout</button>
            </form>
        </div>
    </div>
</header>
