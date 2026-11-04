@if(request()->routeIs('home'))
{{-- ======================================================
     FLOATING QUICK-NAVIGATION SHORTCUT MENU
     Position: Bottom-Left (bottom: 24px / left: 24px)
     Zero-overlap counterpart to Bottom-Right WhatsApp CTA
====================================================== --}}
<div x-data="{ open: false }"
     @keydown.escape.window="open = false"
     @click.outside="open = false"
     class="fixed bottom-6 left-6 z-50 flex flex-col items-start font-inter">

    {{-- EXPANDED SHORTCUT MENU --}}
    <nav x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-3 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-3 scale-95"
         id="floating-shortcuts-menu"
         role="menu"
         aria-label="Quick navigation shortcuts"
         class="mb-3 w-48 rounded-2xl bg-navy-900/95 backdrop-blur-xl border border-cyan-500/20 shadow-2xl shadow-cyan-500/10 p-2 space-y-1">

        {{-- 1. Services --}}
        <a href="#services"
           @click="open = false"
           role="menuitem"
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2 focus:ring-offset-navy-950 transition-all duration-200 group">
            <span class="w-7 h-7 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 group-hover:border-cyan-500/40 group-hover:bg-cyan-500/20 transition-all">
                <i class="fa-solid fa-layer-group text-xs"></i>
            </span>
            <span>Services</span>
        </a>

        {{-- 2. Products --}}
        <a href="#products"
           @click="open = false"
           role="menuitem"
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2 focus:ring-offset-navy-950 transition-all duration-200 group">
            <span class="w-7 h-7 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 group-hover:border-cyan-500/40 group-hover:bg-cyan-500/20 transition-all">
                <i class="fa-solid fa-diagram-project text-xs"></i>
            </span>
            <span>Products</span>
        </a>

        {{-- 3. Pricing --}}
        <a href="#pricing"
           @click="open = false"
           role="menuitem"
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2 focus:ring-offset-navy-950 transition-all duration-200 group">
            <span class="w-7 h-7 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 group-hover:border-cyan-500/40 group-hover:bg-cyan-500/20 transition-all">
                <i class="fa-solid fa-tags text-xs"></i>
            </span>
            <span>Pricing</span>
        </a>

        {{-- 4. Blog --}}
        <a href="{{ route('blog')}}"
           @click="open = false"
           role="menuitem"
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2 focus:ring-offset-navy-950 transition-all duration-200 group">
            <span class="w-7 h-7 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 group-hover:border-cyan-500/40 group-hover:bg-cyan-500/20 transition-all">
                <i class="fa-solid fa-newspaper text-xs"></i>
            </span>
            <span>Blog</span>
        </a>

        {{-- 5. Contact --}}
        <a href="#contact"
           @click="open = false"
           role="menuitem"
           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2 focus:ring-offset-navy-950 transition-all duration-200 group">
            <span class="w-7 h-7 rounded-lg bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 group-hover:border-cyan-500/40 group-hover:bg-cyan-500/20 transition-all">
                <i class="fa-solid fa-envelope text-xs"></i>
            </span>
            <span>Contact</span>
        </a>
    </nav>

    {{-- CIRCULAR TOGGLE BUTTON --}}
    <button type="button"
            @click="open = !open"
            aria-label="Quick navigation shortcuts"
            :aria-expanded="open.toString()"
            aria-controls="floating-shortcuts-menu"
            aria-haspopup="true"
            class="w-14 h-14 rounded-full bg-navy-900/95 backdrop-blur-xl border border-cyan-500/30 text-cyan-400 flex items-center justify-center shadow-2xl shadow-cyan-500/20 hover:border-cyan-400 hover:text-white hover:shadow-cyan-500/40 hover:scale-105 active:scale-95 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-offset-2 focus:ring-offset-navy-950 transition-all duration-200 group">
        {{-- Collapsed: Compass / Navigation Icon --}}
        <svg x-show="!open" class="w-6 h-6 transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke-width="1.8"/>
            <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76" fill="currentColor" fill-opacity="0.2"/>
        </svg>
        {{-- Expanded: Close Icon --}}
        <svg x-show="open" x-cloak class="w-6 h-6 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
    </button>
</div>
@endif
