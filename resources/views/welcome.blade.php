@extends('layouts.app')

@section('title', $data->settings['site_title'] ?? 'AmanProjects — Custom Software, SaaS & Security Solutions | Saharsa, Bihar, India')
@section('meta_description', $data->settings['meta_description'] ?? 'AmanProjects builds premium custom software, SaaS platforms, and cybersecurity solutions. Trusted by clients across India. Web Development, API Integration & more.')
@section('meta_keywords', $data->settings['meta_keywords'] ?? 'software company bihar, custom software india, saas development, laravel developer, ethical hacking, web development bihar, amanprojects')
@section('use_tailwind', true)

@section('content')
@php
    // Controller pre-computes these — just alias for convenience in blade
    $firstWord  = $siteNameParts[0] ?? 'Aman';
    $secondWord = $siteNameParts[1] ?? 'Projects';
    $siteName   = $data->settings['site_name'] ?? 'AmanProjects';
@endphp
{{-- ======================================================
     TOP BAR
====================================================== --}}
<div class="w-full bg-navy-950/90 border-b border-cyan-500/10 py-2 px-4 md:px-8 hidden md:block" style="background:#020817;">
    <div class="max-w-7xl mx-auto flex items-center justify-between text-sm text-slate-400">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <span>{{ $data->profile?->location ?? 'Saharsa, Bihar, India' }}</span>
        </div>
        <div class="flex items-center gap-6">
            @if($data->profile?->phone)
            <a href="tel:{{ $data->profile->phone }}" class="flex items-center gap-2 hover:text-cyan-400 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                {{ $data->profile->phone }}
            </a>
            <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 bg-green-500/10 border border-green-500/30 text-green-400 px-3 py-1 rounded-full hover:bg-green-500/20 transition-all">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </a>
            @endif
            @if($data->user?->email)
            <a href="mailto:{{ $data->user->email }}" class="flex items-center gap-2 hover:text-cyan-400 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Contact Us
            </a>
            @endif
        </div>
    </div>
</div>

{{-- ======================================================
     NAVBAR
====================================================== --}}
<header
    id="navbar"
    x-data="{ open: false, scrolled: false }"
    @scroll.window="scrolled = (window.scrollY > 50)"
    :class="scrolled ? 'bg-navy-900/95 backdrop-blur-xl shadow-lg shadow-cyan-500/5 border-b border-cyan-500/10' : 'bg-transparent border-b border-transparent'"
    class="sticky top-0 z-50 transition-all duration-300 w-full">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- LOGO --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 group" aria-label="{{ $siteName }} — Home" itemprop="url">
                @if(!empty($data->settings['logo']))
                    <img src="@fileUrl($data->settings['logo'])" alt="{{ $siteName }} logo" width="180" height="36" class="h-9 w-auto max-w-[180px] object-contain transition-all duration-200" fetchpriority="high">
                @else
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-cyan-500 to-electric-500 flex items-center justify-center shadow-lg shadow-cyan-500/30 group-hover:shadow-cyan-500/50 transition-all" aria-hidden="true">
                        <span class="text-white font-grotesk font-bold text-sm">
                            @if(isset($firstWord[0]) && isset($secondWord[0]))
                                {{ strtoupper($firstWord[0] . $secondWord[0]) }}
                            @else
                                {{ strtoupper(substr($siteName, 0, 2)) }}
                            @endif
                        </span>
                    </div>
                    <span class="font-grotesk font-bold text-xl text-white" itemprop="name">{{ $firstWord }}<span class="text-cyan-400">{{ $secondWord }}</span><span class="text-cyan-500 ml-0.5">.</span></span>
                @endif
            </a>

            {{-- DESKTOP NAV --}}
            <nav class="hidden md:flex items-center gap-1" aria-label="Main navigation">
                <a href="#home" class="px-4 py-2 text-slate-400 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/5 transition-all duration-200 relative group">
                    Home
                    <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-cyan-400 rounded-full transition-all duration-300 group-hover:w-4"></span>
                </a>
                <a href="#services" class="px-4 py-2 text-slate-400 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/5 transition-all duration-200 relative group">
                    Services
                    <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-cyan-400 rounded-full transition-all duration-300 group-hover:w-4"></span>
                </a>
                @if(isset($data->settings['projects_enabled']) && $data->settings['projects_enabled'] && isset($data->projects) && $data->projects->isNotEmpty())
                    <a href="#products" class="px-4 py-2 text-slate-400 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/5 transition-all duration-200 relative group">
                        Products
                        <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-cyan-400 rounded-full transition-all duration-300 group-hover:w-4"></span>
                    </a>
                @endif
                @if(isset($data->settings['skills_enabled']) && $data->settings['skills_enabled'] && isset($data->skills) && $data->skills->isNotEmpty())
                    <a href="#skills" class="px-4 py-2 text-slate-400 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/5 transition-all duration-200 relative group">
                        Skills
                        <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-cyan-400 rounded-full transition-all duration-300 group-hover:w-4"></span>
                    </a>
                @endif
                @if(isset($data->settings['experience_enabled']) && $data->settings['experience_enabled'] && isset($data->experiences) && $data->experiences->isNotEmpty())
                    <a href="#experience" class="px-4 py-2 text-slate-400 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/5 transition-all duration-200 relative group">
                        Experience
                        <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-cyan-400 rounded-full transition-all duration-300 group-hover:w-4"></span>
                    </a>
                @endif
                @if(isset($data->settings['education_enabled']) && $data->settings['education_enabled'] && isset($data->educations) && $data->educations->isNotEmpty())
                    <a href="#education" class="px-4 py-2 text-slate-400 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/5 transition-all duration-200 relative group">
                        Education
                        <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-cyan-400 rounded-full transition-all duration-300 group-hover:w-4"></span>
                    </a>
                @endif
                <a href="#pricing" class="px-4 py-2 text-slate-400 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/5 transition-all duration-200 relative group">
                    Pricing
                    <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-cyan-400 rounded-full transition-all duration-300 group-hover:w-4"></span>
                </a>
                @if(isset($data->settings['blog_enabled']) && $data->settings['blog_enabled'] && isset($data->posts) && $data->posts->isNotEmpty())
                    <a href="#codebb" class="px-4 py-2 text-slate-400 hover:text-cyan-400 text-sm font-medium rounded-lg hover:bg-cyan-500/5 transition-all duration-200 relative group">
                        CodeBB
                        <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-0 h-0.5 bg-cyan-400 rounded-full transition-all duration-300 group-hover:w-4"></span>
                    </a>
                @endif
                <a href="#contact" class="ml-4 px-5 py-2 bg-gradient-to-r from-cyan-500 to-electric-500 text-white text-sm font-semibold rounded-lg btn-glow hover:scale-105 transition-all">
                    Get a Quote
                </a>
            </nav>

            {{-- HAMBURGER --}}
            <button @click="open = !open" class="md:hidden text-slate-400 hover:text-cyan-400 transition-colors p-2 rounded-lg hover:bg-cyan-500/10" aria-label="Toggle menu" :aria-expanded="open">
                <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- MOBILE MENU --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden glass-card border-t border-cyan-500/10 mt-1 pb-4"
            x-cloak
        >
            <div class="flex flex-col gap-1 pt-2 px-2">
                <a href="#home" @click="open = false" class="px-4 py-3 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-all text-sm font-medium">Home</a>
                <a href="#services" @click="open = false" class="px-4 py-3 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-all text-sm font-medium">Services</a>
                @if(isset($data->settings['projects_enabled']) && $data->settings['projects_enabled'] && isset($data->projects) && $data->projects->isNotEmpty())
                <a href="#products" @click="open = false" class="px-4 py-3 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-all text-sm font-medium">Products</a>
                @endif
                @if(isset($data->settings['skills_enabled']) && $data->settings['skills_enabled'] && isset($data->skills) && $data->skills->isNotEmpty())
                <a href="#skills" @click="open = false" class="px-4 py-3 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-all text-sm font-medium">Skills</a>
                @endif
                @if(isset($data->settings['experience_enabled']) && $data->settings['experience_enabled'] && isset($data->experiences) && $data->experiences->isNotEmpty())
                <a href="#experience" @click="open = false" class="px-4 py-3 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-all text-sm font-medium">Experience</a>
                @endif
                @if(isset($data->settings['education_enabled']) && $data->settings['education_enabled'] && isset($data->educations) && $data->educations->isNotEmpty())
                <a href="#education" @click="open = false" class="px-4 py-3 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-all text-sm font-medium">Education</a>
                @endif
                <a href="#pricing" @click="open = false" class="px-4 py-3 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-all text-sm font-medium">Pricing</a>
                @if(isset($data->settings['blog_enabled']) && $data->settings['blog_enabled'] && isset($data->posts) && $data->posts->isNotEmpty())
                <a href="#codebb" @click="open = false" class="px-4 py-3 text-slate-300 hover:text-cyan-400 hover:bg-cyan-500/10 rounded-lg transition-all text-sm font-medium">CodeBB</a>
                @endif
                <a href="#contact" @click="open = false" class="mt-2 mx-2 px-5 py-3 bg-gradient-to-r from-cyan-500 to-electric-500 text-white text-sm font-semibold rounded-lg text-center btn-glow">Get a Quote</a>
                {{-- Mobile contact strip --}}
                <div class="flex items-center justify-center gap-4 mt-3 pt-3 border-t border-cyan-500/10">
                    @if($data->profile?->phone)
                    <a href="tel:{{ $data->profile->phone }}" class="text-xs text-slate-400 hover:text-cyan-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $data->profile->phone }}
                    </a>
                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener noreferrer" class="text-xs text-green-400 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

{{-- ======================================================
     ========= HERO SECTION =========
====================================================== --}}
<section id="home" class="relative min-h-screen flex flex-col justify-center overflow-hidden py-10 lg:py-0" itemscope itemtype="https://schema.org/WPHeader">
    {{-- Background gradient blobs --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-20 left-10 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-electric-500/8 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-cyan-600/4 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-8 grid lg:grid-cols-2 gap-12 lg:gap-16 items-center relative z-10 py-16">

        {{-- Left: Text Content --}}
        <div class="flex flex-col gap-6">
            {{-- Badge --}}
            <div class="inline-flex self-start items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-sm font-medium" data-aos="fade-right" data-aos-delay="100">
                <span class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse" aria-hidden="true"></span>
                <span>{{ $data->settings['hero_badge'] ?? ('Trusted Software Partner from ' . ($data->profile?->location ?? 'Saharsa, Bihar, India')) }}</span>
            </div>

            {{-- Headline --}}
            <div data-aos="fade-up" data-aos-delay="200">
                <h1 class="font-grotesk font-bold text-4xl sm:text-5xl lg:text-6xl xl:text-7xl leading-tight text-white" itemprop="headline">
                    {!! \App\Http\Controllers\HomeController::renderHeadline($data->settings['hero_title_line1'] ?? 'We Build.') !!}<br>
                    {!! \App\Http\Controllers\HomeController::renderHeadline($data->settings['hero_title_line2'] ?? 'We Scale.') !!}<br>
                    {!! \App\Http\Controllers\HomeController::renderHeadline($data->settings['hero_title_line3'] ?? 'We Secure.') !!}
                </h1>
            </div>

            {{-- Subtext --}}
            <p class="text-slate-400 text-lg md:text-xl leading-relaxed max-w-lg" data-aos="fade-up" data-aos-delay="300">
                {{ $data->settings['hero_subtitle'] ?? 'Custom Software, SaaS Products & Security Solutions from Saharsa, Bihar, India. We turn your ideas into powerful digital products that drive real business results.' }}
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="400">
                <a href="{{ $data->settings['hero_cta1_link'] ?? '#products' }}" id="hero-view-demo-btn"
                   class="group flex items-center gap-3 px-6 py-3.5 bg-gradient-to-r from-cyan-500 to-electric-500 text-white font-semibold rounded-xl btn-glow text-sm transition-all">
                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.069A1 1 0 0121 8.82v6.36a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $data->settings['hero_cta1_text'] ?? 'View Demo' }}
                </a>
                <a href="{{ $data->settings['hero_cta2_link'] ?? '#products' }}" id="hero-view-products-btn"
                   class="group flex items-center gap-3 px-6 py-3.5 bg-transparent border border-cyan-500/40 text-cyan-400 font-semibold rounded-xl hover:bg-cyan-500/10 hover:border-cyan-400 text-sm transition-all">
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    {{ $data->settings['hero_cta2_text'] ?? 'View Products' }}
                </a>
            </div>

            {{-- Mini trust indicators --}}
            <div class="flex flex-wrap items-center gap-6 pt-2" data-aos="fade-up" data-aos-delay="500">
                <div class="flex items-center gap-2 text-slate-400 text-sm">
                    <svg class="w-4 h-4 text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ $data->settings['hero_trust1'] ?? '20+ Projects Delivered' }}
                </div>
                <div class="flex items-center gap-2 text-slate-400 text-sm">
                    <svg class="w-4 h-4 text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ $data->settings['hero_trust2'] ?? 'Security-First Approach' }}
                </div>
                <div class="flex items-center gap-2 text-slate-400 text-sm">
                    <svg class="w-4 h-4 text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ $data->settings['hero_trust3'] ?? 'Made in India 🇮🇳' }}
                </div>
            </div>
            </div>

        {{-- Right: Project Carousel — heroProjects pre-built in controller --}}
        <div class="relative" data-aos="fade-left" data-aos-delay="300">
            {{-- Decorative glow ring --}}
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/20 to-electric-500/20 rounded-2xl blur-2xl scale-105" aria-hidden="true"></div>

            <div class="relative glass-card p-1 rounded-2xl border border-cyan-500/20 shadow-2xl shadow-cyan-500/10">
                {{-- Swiper Carousel --}}
                <div class="swiper heroSwiper rounded-xl" role="region" aria-label="Featured projects carousel" style="--swiper-navigation-color: #06b6d4; --swiper-pagination-color: #06b6d4; --swiper-navigation-size: 20px;">
                    <div class="swiper-wrapper">
                        @foreach($heroProjects as $project)
                        <div class="swiper-slide">
                            <div class="relative h-64 md:h-80 bg-gradient-to-br {{ $project['color'] }} rounded-xl flex flex-col items-center justify-center gap-4 overflow-hidden group">
                                @if(!empty($project['thumbnail']))
                                    <img src="@fileUrl($project['thumbnail'])" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="{{ $project['name'] }} — AmanProjects" width="640" height="320" loading="eager" fetchpriority="high">
                                    <div class="absolute inset-0 bg-slate-950/60 group-hover:bg-slate-950/50 transition-colors duration-300"></div>
                                @else
                                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.2) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);" aria-hidden="true"></div>
                                    <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(rgba(255,255,255,0.5) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.5) 1px, transparent 1px); background-size: 40px 40px;" aria-hidden="true"></div>
                                @endif
                                {{-- Mock browser bar --}}
                                <div class="absolute top-0 left-0 right-0 h-8 bg-black/30 flex items-center px-4 gap-2 z-10" aria-hidden="true">
                                    <span class="w-3 h-3 rounded-full bg-red-400"></span>
                                    <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                                    <span class="w-3 h-3 rounded-full bg-green-400"></span>
                                    <span class="ml-3 text-white/50 text-xs">{{ url()->current() }}/{{ $project['slug'] ?? strtolower(str_replace(' ', '-', $project['name'])) }}</span>
                                </div>
                                {{-- Content --}}
                                <div class="text-center mt-4 z-10">
                                    <div class="w-16 h-16 mx-auto mb-3 rounded-2xl bg-white/15 backdrop-blur-sm border border-white/20 flex items-center justify-center shadow-xl" aria-hidden="true">
                                        <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">{!! $project['icon'] !!}</svg>
                                    </div>
                                    <h3 class="font-grotesk font-bold text-2xl text-white">{{ $project['name'] }}</h3>
                                    <p class="text-white/70 text-sm mt-1 px-4">{{ $project['desc'] }}</p>
                                </div>
                                {{-- Hover overlay --}}
                                <a href="{{ $project['url'] ?? '#products' }}" class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center z-20" aria-label="View {{ $project['name'] }} project">
                                    <span class="px-4 py-2 bg-white/20 backdrop-blur-sm rounded-lg text-white text-sm font-medium">View Project →</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                    {{-- Navigation Arrows --}}
                    <div class="swiper-button-prev hero-nav-btn"></div>
                    <div class="swiper-button-next hero-nav-btn"></div>
                    <div class="swiper-pagination" style="bottom: 12px;"></div>
                </div>

                {{-- Overlay info bar --}}
                <div class="flex items-center justify-between px-4 py-3">
                    <span class="text-slate-400 text-xs">Featured Projects</span>
                    <div class="flex items-center gap-1.5">
                        <span class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></span>
                        <span class="text-cyan-400 text-xs font-medium">Live & Deployed</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce" data-aos="fade-up" data-aos-delay="600">
        <span class="text-slate-500 text-xs tracking-widest uppercase">Scroll</span>
        <svg class="w-5 h-5 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
    </div>
</section>

{{-- ======================================================
     ========= STATS BAR =========
====================================================== --}}
<section id="stats" class="py-16 relative">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="relative glass-card border border-cyan-500/15 p-8 rounded-2xl overflow-hidden" data-aos="fade-up">
            {{-- Gradient border shimmer --}}
            <div class="absolute inset-0 rounded-2xl pointer-events-none" style="background: linear-gradient(135deg, rgba(6,182,212,0.08) 0%, transparent 50%, rgba(14,165,233,0.08) 100%);"></div>
            <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, #06b6d4, transparent);"></div>
            <div class="absolute bottom-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, #0ea5e9, transparent);"></div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 relative z-10">
                @php
                $stats = isset($data->stats) && $data->stats->isNotEmpty() ? $data->stats : collect([
                    ['value' => 20, 'suffix' => '+', 'label' => 'Projects Delivered', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ['value' => 10, 'suffix' => '+', 'label' => 'Happy Clients', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                    ['value' => 3, 'suffix' => '+', 'label' => 'Years Experience', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ['value' => 10, 'suffix' => '+', 'label' => 'Technologies', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                ]);
                @endphp
                @foreach($stats as $i => $stat)
                <div class="flex flex-col items-center text-center gap-3 group" data-aos="zoom-in" data-aos-delay="{{ 100 * ($i + 1) }}">
                    <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center group-hover:bg-cyan-500/20 group-hover:border-cyan-500/40 transition-all">
                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/></svg>
                    </div>
                    <div>
                        <div class="font-grotesk font-bold text-3xl md:text-4xl text-white counter-stat" data-target="{{ $stat['value'] }}">{{ $stat['value'] }}</div>
                        <div class="text-cyan-400 font-bold text-xl -mt-1">{{ $stat['suffix'] }}</div>
                        <div class="text-slate-400 text-sm mt-1">{{ $stat['label'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="section-divider max-w-7xl mx-auto my-2 opacity-30"></div>

{{-- ======================================================
     ========= SERVICES SECTION =========
====================================================== --}}
<section id="services" class="py-20 relative" itemscope itemtype="https://schema.org/Service">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3">{{ $data->settings['services_badge'] ?? 'What We Do' }}</span>
            <h2 class="font-grotesk font-bold text-3xl md:text-4xl lg:text-5xl text-white" itemprop="name">{!! \App\Http\Controllers\HomeController::renderHeadline($data->settings['services_title'] ?? 'Our Services') !!}</h2>
            <p class="text-slate-400 mt-4 text-lg max-w-2xl mx-auto" itemprop="description">{{ $data->settings['services_subtitle'] ?? 'We deliver end-to-end digital solutions tailored for startups, SMBs, and enterprises — built for performance, security, and scale.' }}</p>
        </div>

        {{-- Services Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
            $services = isset($data->services) && $data->services->isNotEmpty() ? $data->services : collect([
                [
                    'title' => 'Web Development',
                    'desc' => 'Pixel-perfect, performant web apps built with Laravel, React, and modern stacks. From landing pages to full enterprise portals.',
                    'color' => 'from-blue-500 to-cyan-500',
                    'bg' => 'blue-500',
                    'icon_path' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                ],
                [
                    'title' => 'SaaS Development',
                    'desc' => 'Multi-tenant SaaS platforms with subscription billing, user management, and cloud-ready infrastructure.',
                    'color' => 'from-purple-500 to-pink-500',
                    'bg' => 'purple-500',
                    'icon_path' => 'M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z',
                ],
                [
                    'title' => 'Ethical Hacking & Security',
                    'desc' => 'Professional penetration testing, security audits, and vulnerability assessments to protect your digital assets.',
                    'color' => 'from-red-500 to-orange-500',
                    'bg' => 'red-500',
                    'icon_path' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                ],
                [
                    'title' => 'API Development & Integration',
                    'desc' => 'RESTful & GraphQL APIs, third-party integrations (payment gateways, SMS, CRMs), and microservices architecture.',
                    'color' => 'from-emerald-500 to-teal-500',
                    'bg' => 'emerald-500',
                    'icon_path' => 'M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
                ],
                [
                    'title' => 'Custom Software Solutions',
                    'desc' => 'Bespoke ERP, CRM, and business automation tools engineered specifically for your operational workflow.',
                    'color' => 'from-amber-500 to-yellow-500',
                    'bg' => 'amber-500',
                    'icon_path' => 'M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z',
                ],
            ]);
            @endphp

            @foreach($services as $i => $svc)
            <div class="glass-card card-hover p-6 rounded-2xl border border-white/5 transition-all duration-300 group relative overflow-hidden"
                 data-aos="fade-up" data-aos-delay="{{ 100 + ($i * 80) }}"
                 itemscope itemtype="https://schema.org/Offer">
                {{-- Top gradient line --}}
                <div class="absolute top-0 left-0 right-0 h-0.5 bg-gradient-to-r {{ $svc['color'] }} opacity-0 group-hover:opacity-100 transition-opacity"></div>

                {{-- Icon --}}
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br {{ $svc['color'] }} p-0.5 mb-5 shadow-lg group-hover:scale-110 transition-transform">
                    <div class="w-full h-full bg-navy-800 rounded-[10px] flex items-center justify-center" style="background:#0d1526;">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $svc['icon_path'] }}"/>
                        </svg>
                    </div>
                </div>

                <h3 class="font-grotesk font-semibold text-xl text-white mb-3 group-hover:text-cyan-300 transition-colors" itemprop="name">{{ $svc['title'] }}</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-5" itemprop="description">{{ $svc['desc'] }}</p>
                <a href="#contact" class="inline-flex items-center gap-2 text-cyan-400 text-sm font-medium hover:gap-3 transition-all group/link" aria-label="Learn more about {{ $svc['title'] }}">
                    Learn More
                    <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            @endforeach

            {{-- CTA card --}}
            <div class="glass-card p-6 rounded-2xl border border-cyan-500/20 flex flex-col items-center justify-center text-center gap-4 bg-gradient-to-br from-cyan-500/10 to-electric-500/5 card-hover transition-all"
                 data-aos="fade-up" data-aos-delay="500">
                <div class="w-14 h-14 rounded-full bg-cyan-500/20 flex items-center justify-center">
                    <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h3 class="font-grotesk font-semibold text-lg text-white mb-2">{{ $data->settings['services_cta_title'] ?? 'Need Something Custom?' }}</h3>
                    <p class="text-slate-400 text-sm">{{ $data->settings['services_cta_desc'] ?? "Every great product starts with a conversation. Let's discuss yours." }}</p>
                </div>
                <a href="{{ $data->settings['services_cta_btn_link'] ?? '#contact' }}" class="px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-electric-500 text-white text-sm font-semibold rounded-xl btn-glow transition-all">
                    {{ $data->settings['services_cta_btn_text'] ?? 'Start a Project' }}
                </a>
            </div>
        </div>
    </div>
</section>

<div class="section-divider max-w-7xl mx-auto my-2 opacity-20"></div>

@if(isset($data->settings['projects_enabled']) && $data->settings['projects_enabled'] && isset($data->projects) && $data->projects->isNotEmpty())
<section id="products" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Header --}}
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3">Our Projects</span>
            <h2 class="font-grotesk font-bold text-3xl md:text-4xl lg:text-5xl text-white">Featured <span class="gradient-text">Projects</span></h2>
            <p class="text-slate-400 mt-4 text-lg max-w-2xl mx-auto">Custom software and SaaS platforms engineered for performance, security, and scale.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($data->projects as $i => $project)
                @php
                    $colors = [
                        'from-blue-600 to-cyan-600',
                        'from-purple-600 to-indigo-600',
                        'from-red-600 to-orange-600',
                        'from-emerald-600 to-teal-600',
                    ];
                    $color = $colors[$i % count($colors)];
                    
                    $icons = [
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>',
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>'
                    ];
                    $icon = $icons[$i % count($icons)];
                @endphp
                <div class="glass-card card-hover rounded-2xl overflow-hidden border border-white/5 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="{{ 100 * ($i + 1) }}" itemscope itemtype="https://schema.org/SoftwareApplication">
                    <div class="relative h-48 bg-gradient-to-br {{ $color }} overflow-hidden">
                        @if($project->thumbnail_image)
                            <img src="@fileUrl($project->thumbnail_image)" alt="{{ $project->title }} — AmanProjects" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-500" width="400" height="192" loading="lazy">
                        @else
                            <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 30px 30px;"></div>
                        @endif
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <div class="w-14 h-14 rounded-xl bg-white/15 border border-white/20 flex items-center justify-center mb-2 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icon !!}</svg>
                            </div>
                            @if(!$project->thumbnail_image)
                                <span class="text-white/80 text-sm font-medium">{{ $project->title }}</span>
                            @endif
                        </div>
                        <div class="absolute top-0 left-0 right-0 h-7 bg-black/30 flex items-center px-3 gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-yellow-400"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-green-400"></span>
                        </div>
                        @if($project->featured)
                            <div class="absolute top-9 right-3 bg-cyan-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-lg shadow-cyan-500/30">FEATURED</div>
                        @else
                            <div class="absolute top-9 right-3 bg-emerald-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-lg shadow-emerald-500/30">LIVE</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <h3 class="font-grotesk font-bold text-xl text-white group-hover:text-cyan-300 transition-colors" itemprop="name">{{ $project->title }}</h3>
                            </div>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed mb-5" itemprop="description">{{ Str::limit($project->description ?? '', 150) }}</p>
                        @if($project->tech_stack_tags)
                            <div class="flex flex-wrap gap-2 mb-5">
                                @foreach(explode(',', $project->tech_stack_tags) as $tag)
                                    <span class="px-2.5 py-1 bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-xs rounded-full">{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex gap-3">
                            @if($project->live_demo_link)
                                <a href="{{ $project->live_demo_link }}" target="_blank" rel="noopener noreferrer" class="flex-1 text-center px-4 py-2.5 bg-gradient-to-r from-cyan-500 to-electric-500 text-white text-sm font-semibold rounded-xl btn-glow transition-all">
                                    View Demo
                                </a>
                            @endif
                            @if($project->github_link)
                                <a href="{{ $project->github_link }}" target="_blank" rel="noopener noreferrer" class="flex-1 text-center px-4 py-2.5 border border-cyan-500/30 text-cyan-400 text-sm font-semibold rounded-xl hover:bg-cyan-500/10 transition-all">
                                    GitHub
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="section-divider max-w-7xl mx-auto my-2 opacity-20"></div>
@endif

{{-- ======================================================
     ========= HOW WE WORK — PROCESS SECTION =========
====================================================== --}}
@if(isset($data->settings['how_we_work_enabled']) && $data->settings['how_we_work_enabled'] && isset($data->projects) && $data->projects->isNotEmpty())
<section id="process" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3">Our Process</span>
            <h2 class="font-grotesk font-bold text-3xl md:text-4xl lg:text-5xl text-white">How We <span class="gradient-text">Work</span></h2>
            <p class="text-slate-400 mt-4 text-lg max-w-xl mx-auto">A proven 5-step process that ensures quality delivery, on time, every time.</p>
        </div>

        @php
        $steps = isset($data->steps) && $data->steps->isNotEmpty() ? $data->steps : collect([
            ['num' => '01', 'title' => 'Requirement Analysis', 'desc' => 'We deep-dive into your goals, audience, and technical requirements to create a precise project blueprint.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
            ['num' => '02', 'title' => 'UI/UX Design', 'desc' => 'Our designers craft stunning, user-centric interfaces with wireframes and interactive prototypes for your approval.', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'],
            ['num' => '03', 'title' => 'Development', 'desc' => 'Clean, documented, and scalable code built with best practices. Regular progress updates and milestone reviews.', 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
            ['num' => '04', 'title' => 'Testing & QA', 'desc' => 'Rigorous testing — unit, integration, security audits, and cross-browser compatibility — before any deployment.', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['num' => '05', 'title' => 'Deployment & Support', 'desc' => 'Smooth server deployment, monitoring setup, and dedicated post-launch support to keep your product running perfectly.', 'icon' => 'M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01'],
        ]);
        @endphp

        {{-- Desktop: Horizontal --}}
        <div class="hidden lg:flex items-start gap-0 relative" data-aos="fade-up" data-aos-delay="100">
            {{-- Connecting line --}}
            <div class="absolute top-10 left-[10%] right-[10%] h-0.5 bg-gradient-to-r from-transparent via-cyan-500/40 to-transparent pointer-events-none"></div>

            @foreach($steps as $i => $step)
            <div class="flex-1 flex flex-col items-center text-center px-4 relative group">
                {{-- Step circle --}}
                <div class="relative z-10 w-20 h-20 rounded-2xl bg-gradient-to-br from-cyan-500 to-electric-500 p-0.5 shadow-lg shadow-cyan-500/20 mb-5 group-hover:shadow-cyan-500/40 transition-all group-hover:scale-110">
                    <div class="w-full h-full rounded-[14px] bg-navy-900 flex flex-col items-center justify-center gap-1" style="background:#0a0f1e;">
                        <svg class="w-7 h-7 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                        </svg>
                        <span class="text-cyan-500 text-xs font-bold">{{ $step['num'] }}</span>
                    </div>
                </div>
                <h3 class="font-grotesk font-semibold text-sm text-white mb-2 group-hover:text-cyan-300 transition-colors">{{ $step['title'] }}</h3>
                <p class="text-slate-500 text-xs leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Mobile/Tablet: Vertical timeline --}}
        <div class="lg:hidden flex flex-col gap-0">
            @foreach($steps as $i => $step)
            <div class="flex gap-5 relative" data-aos="fade-right" data-aos-delay="{{ 100 * ($i + 1) }}">
                {{-- Left: step number + line --}}
                <div class="flex flex-col items-center gap-0">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500 to-electric-500 p-0.5 shadow-lg shadow-cyan-500/20 flex-shrink-0">
                        <div class="w-full h-full rounded-[10px] bg-navy-900 flex flex-col items-center justify-center gap-0.5" style="background:#0a0f1e;">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $step['icon'] }}"/>
                            </svg>
                            <span class="text-cyan-500 text-xs font-bold">{{ $step['num'] }}</span>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <div class="w-0.5 flex-1 my-1 bg-gradient-to-b from-cyan-500/40 to-transparent min-h-[2rem]"></div>
                    @endif
                </div>
                {{-- Right: content --}}
                <div class="pb-8">
                    <h3 class="font-grotesk font-semibold text-white mb-1.5">{{ $step['title'] }}</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="section-divider max-w-7xl mx-auto my-2 opacity-20"></div>
@endif

@if(isset($data->settings['skills_enabled']) && $data->settings['skills_enabled'] && isset($data->skills) && $data->skills->isNotEmpty())
<section id="skills" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 md:px-8">
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3">My Skills</span>
            <h2 class="font-grotesk font-bold text-3xl md:text-4xl lg:text-5xl text-white">Skills &amp; <span class="gradient-text">Technologies</span></h2>
            <p class="text-slate-400 mt-4 text-lg max-w-xl mx-auto">A comprehensive overview of my technical expertise and proficiency levels.</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach($data->skills as $i => $skill)
                @php
                    $skillName = strtolower($skill->name);
                    $category = strtolower($skill->category ?? '');
                    $iconClass = match(true) {
                        str_contains($skillName, 'react') => 'fa-brands fa-react text-cyan-400',
                        str_contains($skillName, 'vue') => 'fa-brands fa-vuejs text-emerald-400',
                        str_contains($skillName, 'laravel') => 'fa-brands fa-laravel text-red-500',
                        str_contains($skillName, 'php') => 'fa-brands fa-php text-indigo-400',
                        str_contains($skillName, 'js') || str_contains($skillName, 'javascript') => 'fa-brands fa-js text-yellow-400',
                        str_contains($skillName, 'typescript') || str_contains($skillName, 'ts') => 'fa-solid fa-code text-blue-400',
                        str_contains($skillName, 'python') => 'fa-brands fa-python text-blue-500',
                        str_contains($skillName, 'css') => 'fa-brands fa-css3-alt text-blue-400',
                        str_contains($skillName, 'tailwind') => 'fa-solid fa-wind text-cyan-400',
                        str_contains($skillName, 'docker') => 'fa-brands fa-docker text-blue-400',
                        str_contains($skillName, 'git') => 'fa-brands fa-git-alt text-orange-500',
                        str_contains($skillName, 'database') || str_contains($skillName, 'sql') || str_contains($skillName, 'mysql') => 'fa-solid fa-database text-blue-300',
                        default => 'fa-solid fa-code text-cyan-400'
                    };
                @endphp
                <div class="glass-card border border-white/5 rounded-2xl p-6 flex flex-col items-center gap-4 group hover:border-cyan-500/30 hover:scale-105 transition-all duration-300 cursor-default" data-aos="zoom-in" data-aos-delay="{{ 50 * $i }}">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500/10 to-electric-500/10 flex items-center justify-center border border-cyan-500/20 group-hover:scale-110 transition-transform">
                        <i class="{{ $iconClass }} text-2xl"></i>
                    </div>
                    <div class="text-center w-full">
                        <h3 class="font-grotesk font-bold text-white text-base group-hover:text-cyan-400 transition-colors">{{ $skill->name }}</h3>
                        @if($skill->category)
                            <span class="text-slate-500 text-xs mt-1 block">{{ $skill->category }}</span>
                        @endif
                        <div class="w-full bg-navy-950 rounded-full h-1.5 mt-3 overflow-hidden border border-cyan-500/5">
                            <div class="bg-gradient-to-r from-cyan-500 to-electric-500 h-1.5 rounded-full" style="width: {{ $skill->level }}%"></div>
                        </div>
                        <span class="text-cyan-400 text-xs font-semibold mt-1.5 block">{{ $skill->level }}% Proficiency</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<div class="section-divider max-w-7xl mx-auto my-2 opacity-20"></div>
@endif

{{-- ======================================================
     ========= WHY CHOOSE US =========
====================================================== --}}
<section id="why-us" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Left: Header + text --}}
            <div data-aos="fade-right">
                <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3">Why AmanProjects?</span>
                <h2 class="font-grotesk font-bold text-3xl md:text-4xl lg:text-5xl text-white mb-6">Why <span class="gradient-text">Choose Us</span></h2>
                <p class="text-slate-400 text-lg leading-relaxed mb-8">We're not just developers — we're digital partners who care about your success. We combine technical excellence with business understanding to build products that truly make a difference.</p>
                <a href="#contact" class="inline-flex items-center gap-3 px-6 py-3.5 bg-gradient-to-r from-cyan-500 to-electric-500 text-white font-semibold rounded-xl btn-glow text-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    Let's Talk
                </a>
            </div>

            {{-- Right: 4 cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                @php
                $whys = isset($data->whys) && $data->whys->isNotEmpty() ? $data->whys : collect([
                    [
                        'icon'  => 'M13 10V3L4 14h7v7l9-11h-7z',
                        'title' => 'Fast Delivery',
                        'desc'  => 'Agile sprints and efficient workflows ensure your project ships on time — always.',
                        'color' => 'from-yellow-500 to-amber-500',
                    ],
                    [
                        'icon'  => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
                        'title' => 'Clean & Scalable Code',
                        'desc'  => 'SOLID principles, proper documentation, and future-proof architecture as standard.',
                        'color' => 'from-green-500 to-emerald-500',
                    ],
                    [
                        'icon'  => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                        'title' => 'Security-First',
                        'desc'  => 'Every product is built with security at its core — OWASP compliance, input validation, and encryption.',
                        'color' => 'from-red-500 to-rose-500',
                    ],
                    [
                        'icon'  => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z',
                        'title' => 'Ongoing Support',
                        'desc'  => "We don't disappear after launch. Dedicated support, bug fixes, and updates — always.",
                        'color' => 'from-purple-500 to-indigo-500',
                    ],
                ]);
                @endphp

                @foreach($whys as $i => $why)
                <div class="glass-card card-hover border border-white/5 rounded-xl p-5 group transition-all duration-300"
                     data-aos="fade-up" data-aos-delay="{{ 100 + ($i * 100) }}">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br {{ $why['color'] }} p-0.5 mb-4 shadow-lg group-hover:scale-110 transition-transform">
                        <div class="w-full h-full rounded-[10px] bg-navy-900 flex items-center justify-center" style="background:#0a0f1e;">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $why['icon'] }}"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-grotesk font-semibold text-white mb-2 group-hover:text-cyan-300 transition-colors">{{ $why['title'] }}</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $why['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="section-divider max-w-7xl mx-auto my-2 opacity-20"></div>


{{-- ======================================================
     ========= PRICING SECTION =========
====================================================== --}}
<section id="pricing" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Header --}}
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3">Simple Pricing</span>
            <h2 class="font-grotesk font-bold text-3xl md:text-4xl lg:text-5xl text-white">Transparent <span class="gradient-text">Pricing</span></h2>
            <p class="text-slate-400 mt-4 text-lg max-w-xl mx-auto">No hidden fees, no surprises. Choose the plan that fits your business needs.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">

            @php
            $plans = isset($data->plans) && $data->plans->isNotEmpty() ? $data->plans : collect([
                [
                    'name' => 'Basic',
                    'price' => '₹4,999',
                    'period' => '/month',
                    'desc' => 'Perfect for startups and small businesses getting started.',
                    'color' => 'border-white/10',
                    'btn_style' => 'border border-cyan-500/30 text-cyan-400 hover:bg-cyan-500/10',
                    'featured' => false,
                    'features' => [
                        '1 Web Application',
                        'Up to 5 Pages',
                        'Basic SEO Setup',
                        'Mobile Responsive',
                        'SSL Certificate',
                        '1 Month Support',
                        '❌ Custom Integrations',
                        '❌ Priority Support',
                    ],
                ],
                [
                    'name' => 'Standard',
                    'price' => '₹9,999',
                    'period' => '/month',
                    'desc' => 'The most popular choice for growing businesses.',
                    'color' => 'border-cyan-500/50',
                    'btn_style' => 'bg-gradient-to-r from-cyan-500 to-electric-500 text-white btn-glow',
                    'featured' => true,
                    'features' => [
                        'Up to 3 Web Applications',
                        'Unlimited Pages',
                        'Advanced SEO + Analytics',
                        'Custom API Integrations',
                        'Payment Gateway Setup',
                        '3 Months Priority Support',
                        'Admin Dashboard',
                        'Monthly Maintenance',
                    ],
                ],
                [
                    'name' => 'Pro',
                    'price' => '₹24,999',
                    'period' => '/month',
                    'desc' => 'Enterprise-grade solutions for established companies.',
                    'color' => 'border-white/10',
                    'btn_style' => 'border border-cyan-500/30 text-cyan-400 hover:bg-cyan-500/10',
                    'featured' => false,
                    'features' => [
                        'Full SaaS Platform',
                        'Multi-tenant Architecture',
                        'Custom Mobile App',
                        'Security Audit Included',
                        'Dedicated Developer',
                        '12 Months Support',
                        'DevOps & CI/CD Setup',
                        '24/7 Priority Support',
                    ],
                ],
            ]);
            @endphp

            @foreach($plans as $i => $plan)
            <div class="relative glass-card card-hover rounded-2xl overflow-hidden border {{ $plan['color'] }} transition-all duration-300 {{ $plan['featured'] ? 'scale-105 shadow-2xl shadow-cyan-500/20 z-10' : '' }}"
                 data-aos="fade-up" data-aos-delay="{{ 100 * ($i + 1) }}">

                @if($plan['featured'])
                {{-- Popular badge --}}
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-cyan-500 to-electric-500"></div>
                <div class="absolute top-4 right-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-cyan-500/20 border border-cyan-500/30 text-cyan-400 text-xs font-bold rounded-full">
                        <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full animate-pulse"></span>
                        Most Popular
                    </span>
                </div>
                @endif

                <div class="p-7">
                    <h3 class="font-grotesk font-bold text-xl text-white mb-1">{{ $plan['name'] }}</h3>
                    <p class="text-slate-400 text-sm mb-5">{{ $plan['desc'] }}</p>
                    <div class="flex items-baseline gap-1 mb-6">
                        <span class="font-grotesk font-bold text-4xl {{ $plan['featured'] ? 'gradient-text' : 'text-white' }}">{{ $plan['price'] }}</span>
                        <span class="text-slate-400 text-sm">{{ $plan['period'] }}</span>
                    </div>
                    <ul class="flex flex-col gap-3 mb-7">
                        @foreach($plan['features'] as $feature)
                        <li class="flex items-start gap-3 text-sm">
                            @if(str_starts_with($feature, '❌'))
                                <svg class="w-4 h-4 text-slate-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                <span class="text-slate-600">{{ str_replace('❌ ', '', $feature) }}</span>
                            @else
                                <svg class="w-4 h-4 text-cyan-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span class="text-slate-300">{{ $feature }}</span>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    <a href="#contact" class="block w-full text-center px-6 py-3 rounded-xl font-semibold text-sm transition-all {{ $plan['btn_style'] }}">
                        Get Started
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <p class="text-center text-slate-500 text-sm mt-8 flex items-center justify-center gap-2" data-aos="fade-up">
            <svg class="w-4 h-4 text-amber-400 inline-block flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            Need a custom quote?
            <a href="#contact" class="text-cyan-400 hover:underline">Contact us</a> — we price per project too.
        </p>
    </div>
</section>

<div class="section-divider max-w-7xl mx-auto my-2 opacity-20"></div>

{{-- ======================================================
     ========= TESTIMONIALS =========
====================================================== --}}
<section id="testimonials" class="py-20 relative" itemscope itemtype="https://schema.org/ItemList">
    <meta itemprop="name" content="Client Testimonials for AmanProjects">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Header --}}
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3">What Clients Say</span>
            <h2 class="font-grotesk font-bold text-3xl md:text-4xl lg:text-5xl text-white">Client <span class="gradient-text">Testimonials</span></h2>
        </div>

        {{-- Swiper --}}
        <div class="swiper testimonialsSwiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper pb-12">

                @php
                $testimonials = isset($data->testimonials) && $data->testimonials->isNotEmpty() ? $data->testimonials : collect([
                    [
                        'name' => 'Rajesh Kumar Sharma',
                        'designation' => 'Director, Sunrise Coaching Centre, Patna',
                        'avatar' => 'RK',
                        'color' => 'from-blue-500 to-cyan-500',
                        'rating' => 5,
                        'text' => 'AP Coaching SaaS transformed how we manage our institute. The fee collection and attendance modules alone saved us 3 hours daily. Aman\'s team was responsive and delivered exactly what we asked for — and more.',
                    ],
                    [
                        'name' => 'Priya Mishra',
                        'designation' => 'Founder, StudyHub Library, Muzaffarpur',
                        'avatar' => 'PM',
                        'color' => 'from-purple-500 to-indigo-500',
                        'rating' => 5,
                        'text' => 'The AP Library system is fantastic. Our members love the online seat booking feature. No more queues, no more confusion. The QR check-in is super smooth. Highly recommend AmanProjects!',
                    ],
                    [
                        'name' => 'Amit Sinha',
                        'designation' => 'CEO, TechRetail Solutions, Delhi',
                        'avatar' => 'AS',
                        'color' => 'from-emerald-500 to-teal-500',
                        'rating' => 5,
                        'text' => 'We hired AmanProjects for a complete ERP integration project. The code quality was exceptional — well-documented, scalable, and secure. The security audit they performed caught 3 critical vulnerabilities. Worth every rupee!',
                    ],
                    [
                        'name' => 'Neha Gupta',
                        'designation' => 'Product Manager, FinTech Startup, Bangalore',
                        'avatar' => 'NG',
                        'color' => 'from-rose-500 to-pink-500',
                        'rating' => 5,
                        'text' => 'From API design to deployment on AWS — the team handled everything flawlessly. Our API handles 50,000+ daily requests with zero downtime. The post-launch support has been excellent. A trusted partner.',
                    ],
                ]);
                @endphp

                @foreach($testimonials as $t)
                <div class="swiper-slide" itemscope itemtype="https://schema.org/Review" itemprop="itemListElement">
                    <div class="glass-card border border-white/5 rounded-2xl p-7 mx-2 h-full relative overflow-hidden group hover:border-cyan-500/20 transition-all">
                        {{-- Quote icon --}}
                        <div class="absolute top-5 right-6 text-6xl text-cyan-500/10 font-grotesk font-bold leading-none select-none" aria-hidden="true">"</div>
                        {{-- Stars --}}
                        <div class="flex gap-1 mb-4" aria-label="{{ $t['rating'] }} out of 5 stars">
                            @for($s = 0; $s < $t['rating']; $s++)
                            <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            @endfor
                            <meta itemprop="reviewRating" content="{{ $t['rating'] }}">
                        </div>
                        <p class="text-slate-300 text-sm leading-relaxed mb-6 italic relative z-10" itemprop="reviewBody">"{{ $t['text'] }}"</p>
                        {{-- Author --}}
                        <div class="flex items-center gap-3" itemprop="author" itemscope itemtype="https://schema.org/Person">
                            <div class="w-11 h-11 rounded-full bg-gradient-to-br {{ $t['color'] ?? 'from-blue-500 to-cyan-500' }} flex items-center justify-center text-white font-grotesk font-bold text-sm flex-shrink-0 shadow-lg overflow-hidden" aria-hidden="true">
                                @if($t['avatar'] && (str_starts_with($t['avatar'], 'uploads/') || str_starts_with($t['avatar'], 'storage/') || str_starts_with($t['avatar'], 'http://') || str_starts_with($t['avatar'], 'https://') || str_contains($t['avatar'], '.')))
                                    <img src="{{ asset($t['avatar']) }}" alt="{{ $t['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <span>{{ $t['avatar'] ?: strtoupper(substr($t['name'], 0, 2)) }}</span>
                                @endif
                            </div>
                            <div>
                                <div class="font-semibold text-white text-sm" itemprop="name">{{ $t['name'] }}</div>
                                <div class="text-slate-400 text-xs mt-0.5" itemprop="jobTitle">{{ $t['designation'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<div class="section-divider max-w-7xl mx-auto my-2 opacity-20"></div>

{{-- ======================================================
     ========= CODEBB PREVIEW =========
====================================================== --}}
@if(isset($data->settings['blog_enabled']) && $data->settings['blog_enabled'] && isset($data->posts) && $data->posts->isNotEmpty())
<section id="codebb" class="py-20 relative">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12" data-aos="fade-up">
            <div>
                <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3">Latest from Blog</span>
                <h2 class="font-grotesk font-bold text-3xl md:text-4xl lg:text-5xl text-white">Dev <span class="gradient-text">Insights</span></h2>
                <p class="text-slate-400 mt-3 text-lg max-w-lg">Code snippets, tutorials, and tech insights from our engineering team.</p>
            </div>
            <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-cyan-400 text-sm font-medium hover:gap-4 transition-all whitespace-nowrap">
                View All Posts
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7">
            @foreach($data->posts as $i => $post)
                @php
                    $colors = [
                        'from-red-600 to-orange-600',
                        'from-red-700 to-rose-700',
                        'from-emerald-600 to-teal-600',
                    ];
                    $color = $colors[$i % count($colors)];
                    
                    $icons = [
                        'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z',
                        'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                        'M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'
                    ];
                    $icon = $icons[$i % count($icons)];
                    
                    $wordCount = str_word_count(strip_tags($post->content));
                    $readTime = ceil($wordCount / 200) ?: 1;
                    
                    $categoryName = $post->categories->first()?->name ?? 'Tech';
                @endphp
                <article class="glass-card card-hover border border-white/5 rounded-2xl overflow-hidden group transition-all duration-300"
                         data-aos="fade-up" data-aos-delay="{{ 100 * ($i + 1) }}">
                    <div class="relative h-44 bg-gradient-to-br {{ $color }} overflow-hidden">
                        @if($post->featured_image)
                            <img src="@fileUrl($post->featured_image)" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(rgba(255,255,255,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 30px 30px;"></div>
                        @endif
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/15 border border-white/20 backdrop-blur-sm flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $icon }}"/>
                                </svg>
                            </div>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 bg-black/40 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/20">{{ $categoryName }}</span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-3 text-slate-500 text-xs">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                            </div>
                            <span>•</span>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $readTime }} min read
                            </div>
                        </div>

                        <h3 class="font-grotesk font-semibold text-white text-base leading-snug mb-3 group-hover:text-cyan-300 transition-colors line-clamp-2">{{ $post->title }}</h3>
                        <p class="text-slate-400 text-sm leading-relaxed mb-4 line-clamp-3">{{ Str::limit(strip_tags($post->content), 150) }}</p>

                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($post->categories as $cat)
                                <span class="px-2 py-0.5 bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-xs rounded-full">{{ $cat->name }}</span>
                            @endforeach
                        </div>

                        <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-2 text-cyan-400 text-sm font-medium hover:gap-3 transition-all group/link">
                            Read More
                            <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<div class="section-divider max-w-7xl mx-auto my-2 opacity-20"></div>
@endif

{{-- ======================================================
     ========= CONTACT SECTION =========
====================================================== --}}
<section id="contact" class="py-20 relative" itemscope itemtype="https://schema.org/ContactPage">
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Header --}}
        <div class="text-center mb-14" data-aos="fade-up">
            <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3">Get In Touch</span>
            <h2 class="font-grotesk font-bold text-3xl md:text-4xl lg:text-5xl text-white">Let's <span class="gradient-text">Build Together</span></h2>
            <p class="text-slate-400 mt-4 text-lg max-w-xl mx-auto">Have a project in mind? We'd love to hear about it. Let's bring your idea to life.</p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">

            {{-- Left: Contact Form --}}
            <div data-aos="fade-right">
                <div class="glass-card border border-white/5 rounded-2xl p-7">
                    <h3 class="font-grotesk font-bold text-xl text-white mb-6">Send Us a Message</h3>

                    <form action="{{ route('contact.store') }}" method="POST" id="contact-form" class="flex flex-col gap-5">
                        @csrf
                        <input type="hidden" name="honeypot" class="hidden" tabindex="-1" autocomplete="off">

                        @if(session('success'))
                        <div class="p-4 rounded-xl bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 text-sm flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ session('success') }}
                        </div>
                        @endif

                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label for="contact-name" class="block text-slate-400 text-sm font-medium mb-2">Full Name *</label>
                                <input type="text" id="contact-name" name="name" required
                                    placeholder="Your full name"
                                    value="{{ old('name') }}"
                                    class="w-full px-4 py-3 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 focus:ring-2 focus:ring-cyan-500/10 transition-all"
                                    style="background: rgba(13,21,38,0.5);">
                                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="contact-email" class="block text-slate-400 text-sm font-medium mb-2">Email Address *</label>
                                <input type="email" id="contact-email" name="email" required
                                    placeholder="your@email.com"
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-3 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 focus:ring-2 focus:ring-cyan-500/10 transition-all"
                                    style="background: rgba(13,21,38,0.5);">
                                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label for="contact-phone" class="block text-slate-400 text-sm font-medium mb-2">Phone Number</label>
                            <input type="tel" id="contact-phone" name="phone"
                                placeholder="+91 XXXXX XXXXX"
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-3 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 focus:ring-2 focus:ring-cyan-500/10 transition-all"
                                style="background: rgba(13,21,38,0.5);">
                        </div>

                        <div>
                            <label for="contact-subject" class="block text-slate-400 text-sm font-medium mb-2">Subject *</label>
                            <input type="text" id="contact-subject" name="subject" required
                                placeholder="What's this about?"
                                value="{{ old('subject') }}"
                                class="w-full px-4 py-3 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 focus:ring-2 focus:ring-cyan-500/10 transition-all"
                                style="background: rgba(13,21,38,0.5);">
                            @error('subject')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label for="contact-message" class="block text-slate-400 text-sm font-medium mb-2">Your Message *</label>
                            <textarea id="contact-message" name="message" rows="5" required
                                placeholder="Tell us about your project, goals, and timeline..."
                                class="w-full px-4 py-3 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 focus:ring-2 focus:ring-cyan-500/10 transition-all resize-none"
                                style="background: rgba(13,21,38,0.5);">{{ old('message') }}</textarea>
                            @error('message')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" id="contact-submit-btn"
                            class="w-full flex items-center justify-center gap-3 px-6 py-3.5 bg-gradient-to-r from-cyan-500 to-electric-500 text-white font-semibold rounded-xl btn-glow text-sm transition-all hover:scale-[1.02] active:scale-[0.98]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            {{-- Right: Contact Info --}}
            <div class="flex flex-col gap-6" data-aos="fade-left">
                {{-- Direct Contact Cards --}}
                <div class="glass-card border border-white/5 rounded-2xl p-7">
                    <h3 class="font-grotesk font-bold text-xl text-white mb-6">Contact Directly</h3>
                    <div class="flex flex-col gap-5">
                        @if($data->profile?->email)
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center flex-shrink-0 group-hover:bg-cyan-500/20 transition-all">
                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <div class="text-slate-400 text-xs mb-0.5">Email Address</div>
                                <a href="mailto:{{ $data->profile->email }}" class="text-white font-medium hover:text-cyan-400 transition-colors" itemprop="email">{{ $data->profile->email }}</a>
                            </div>
                        </div>
                        @endif

                        @if($data->profile?->phone)
                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-xl bg-green-500/10 border border-green-500/20 flex items-center justify-center flex-shrink-0 group-hover:bg-green-500/20 transition-all">
                                <svg class="w-6 h-6 text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            </div>
                            <div>
                                <div class="text-slate-400 text-xs mb-0.5">WhatsApp</div>
                                <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener noreferrer" class="text-white font-medium hover:text-green-400 transition-colors" itemprop="telephone">{{ $data->profile->phone }}</a>
                            </div>
                        </div>
                        @endif

                        <div class="flex items-center gap-4 group">
                            <div class="w-12 h-12 rounded-xl bg-electric-500/10 border border-electric-500/20 flex items-center justify-center flex-shrink-0 group-hover:bg-electric-500/20 transition-all">
                                <svg class="w-6 h-6 text-electric-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <div class="text-slate-400 text-xs mb-0.5">Location</div>
                                <span class="text-white font-medium">{{ $data->profile?->location ?? 'Saharsa, Bihar, India 🇮🇳' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if($data->profile?->phone)
                {{-- WhatsApp CTA --}}
                <a href="https://wa.me/{{ $cleanPhone }}?text=Hi%20{{ rawurlencode($siteName) }}!%20I%20want%20to%20discuss%20a%20project." target="_blank" rel="noopener noreferrer"
                   id="whatsapp-cta-btn"
                   class="glass-card border border-green-500/20 rounded-2xl p-6 flex items-center gap-5 hover:bg-green-500/5 hover:border-green-500/40 transition-all group">
                    <div class="w-14 h-14 rounded-2xl bg-green-500/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </div>
                    <div>
                        <div class="font-grotesk font-semibold text-white mb-1 group-hover:text-green-300 transition-colors">Chat on WhatsApp</div>
                        <div class="text-slate-400 text-sm">Typically replies within 1 hour</div>
                    </div>
                    <svg class="w-5 h-5 text-slate-500 ml-auto group-hover:translate-x-1 group-hover:text-green-400 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                @endif

                {{-- Business hours --}}
                <div class="glass-card border border-white/5 rounded-2xl p-6">
                    <h4 class="font-semibold text-white mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Business Hours
                    </h4>
                    <div class="flex flex-col gap-2.5">
                        @foreach([
                            ['Mon – Fri', '9:00 AM – 7:00 PM IST', true],
                            ['Saturday', '10:00 AM – 4:00 PM IST', true],
                            ['Sunday', 'Closed', false],
                        ] as [$day, $hours, $open])
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-400">{{ $day }}</span>
                            <span class="{{ $open ? 'text-cyan-400' : 'text-slate-600' }} font-medium">{{ $hours }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================================================
     ========= HIDDEN FAQ SECTION (AIO — AI Overview Optimization)
     Visible only to crawlers/screen-readers, not to users
====================================================== --}}
<section aria-label="Frequently Asked Questions" class="sr-only" itemscope itemtype="https://schema.org/FAQPage">
    <h2>Frequently Asked Questions about AmanProjects</h2>
    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <h3 itemprop="name">What services does AmanProjects offer?</h3>
        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <p itemprop="text">AmanProjects offers custom software development, SaaS platform development, ethical hacking & cybersecurity audits, RESTful & GraphQL API development, and custom ERP/CRM solutions for startups and enterprises across India.</p>
        </div>
    </div>
    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <h3 itemprop="name">Is AmanProjects based in Saharsa, Bihar, India?</h3>
        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <p itemprop="text">Yes. AmanProjects is a software company proudly based in Saharsa, Bihar, India. We serve clients across India and globally, delivering premium digital products remotely.</p>
        </div>
    </div>
    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <h3 itemprop="name">What technologies does AmanProjects use?</h3>
        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <p itemprop="text">We specialize in Laravel (PHP), React, Node.js, MySQL, REST APIs, and cloud infrastructure on AWS and DigitalOcean. We follow security-first development practices compliant with OWASP standards.</p>
        </div>
    </div>
    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <h3 itemprop="name">How much does a web application cost at AmanProjects?</h3>
        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <p itemprop="text">Pricing starts at ₹4,999/month for basic web applications. SaaS platforms and enterprise software are priced per project. Contact us for a free custom quote.</p>
        </div>
    </div>
    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <h3 itemprop="name">Does AmanProjects provide cybersecurity services?</h3>
        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <p itemprop="text">Yes. We provide professional penetration testing, OWASP-based security audits, vulnerability assessments, and security consulting for web applications and APIs.</p>
        </div>
    </div>
    <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
        <h3 itemprop="name">How can I contact AmanProjects?</h3>
        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
            <p itemprop="text">You can reach AmanProjects via the contact form on our website, by email, or on WhatsApp. We typically respond within 1 hour during business hours (Mon–Fri, 9 AM–7 PM IST).</p>
        </div>
    </div>
</section>

{{-- ======================================================
     ========= FOOTER =========
====================================================== --}}
<footer class="relative border-t border-white/5 pt-16 pb-8" style="background: rgba(2,8,23,0.9);">
    <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent, #06b6d4, transparent); opacity:0.3;"></div>
    <div class="max-w-7xl mx-auto px-4 md:px-8">

        {{-- Footer Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-10 mb-12">

            {{-- Brand Column --}}
            <div class="col-span-2 md:col-span-4 lg:col-span-2">
                <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                    @if(!empty($data->settings['logo']))
                        <img src="@fileUrl($data->settings['logo'])" alt="{{ $siteName }}" class="h-9 w-auto max-w-[180px] object-contain transition-all duration-200">
                    @else
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-cyan-500 to-electric-500 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                            <span class="text-white font-grotesk font-bold text-sm">
                                @if(isset($firstWord[0]) && isset($secondWord[0]))
                                    {{ strtoupper($firstWord[0] . $secondWord[0]) }}
                                @else
                                    {{ strtoupper(substr($siteName, 0, 2)) }}
                                @endif
                            </span>
                        </div>
                        <span class="font-grotesk font-bold text-xl text-white">{{ $firstWord }}<span class="text-cyan-400">{{ $secondWord }}</span><span class="text-cyan-500 ml-0.5">.</span></span>
                    @endif
                </a>
                <p class="text-slate-400 text-sm leading-relaxed mb-5 max-w-xs">
                    Building digital excellence from Saharsa, Bihar, India. Custom software, SaaS products, and cybersecurity solutions for businesses across India and beyond.
                </p>
                {{-- Social Icons --}}
                <div class="flex items-center gap-3">
                    @if(isset($data->socialLinks) && $data->socialLinks->isNotEmpty())
                        @foreach($data->socialLinks as $link)
                            @php
                                $lowerName = strtolower($link->name);
                                $iconClass = match(true) {
                                    str_contains($lowerName, 'github') => 'fa-brands fa-github text-slate-400 hover:text-white',
                                    str_contains($lowerName, 'youtube') => 'fa-brands fa-youtube text-red-400 hover:text-white',
                                    str_contains($lowerName, 'linkedin') => 'fa-brands fa-linkedin text-blue-400 hover:text-white',
                                    str_contains($lowerName, 'whatsapp') => 'fa-brands fa-whatsapp text-green-400 hover:text-white',
                                    str_contains($lowerName, 'twitter') || str_contains($lowerName, 'x') => 'fa-brands fa-x-twitter text-slate-400 hover:text-white',
                                    str_contains($lowerName, 'facebook') => 'fa-brands fa-facebook text-blue-500 hover:text-white',
                                    str_contains($lowerName, 'instagram') => 'fa-brands fa-instagram text-pink-500 hover:text-white',
                                    default => 'fa-solid fa-link text-cyan-400'
                                };
                                $bgClass = match(true) {
                                    str_contains($lowerName, 'github') => 'bg-white/5 border-white/10 hover:border-white/20',
                                    str_contains($lowerName, 'youtube') => 'bg-red-500/10 border-red-500/20 hover:border-red-500/40 hover:bg-red-500/20',
                                    str_contains($lowerName, 'linkedin') => 'bg-blue-500/10 border-blue-500/20 hover:border-blue-500/40 hover:bg-blue-500/20',
                                    str_contains($lowerName, 'whatsapp') => 'bg-green-500/10 border-green-500/20 hover:border-green-500/40 hover:bg-green-500/20',
                                    str_contains($lowerName, 'twitter') || str_contains($lowerName, 'x') => 'bg-white/5 border-white/10 hover:border-white/20',
                                    str_contains($lowerName, 'facebook') => 'bg-blue-500/10 border-blue-500/20 hover:border-blue-500/40',
                                    str_contains($lowerName, 'instagram') => 'bg-pink-500/10 border-pink-500/20 hover:border-pink-500/40',
                                    default => 'bg-cyan-500/10 border-cyan-500/20 hover:border-cyan-500/40'
                                };
                            @endphp
                            <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                               class="w-9 h-9 rounded-lg {{ $bgClass }} flex items-center justify-center transition-all" aria-label="{{ $link->name }}">
                                <i class="{{ $iconClass }} text-base"></i>
                            </a>
                        @endforeach
                    @else
                        {{-- Static fallback if empty --}}
                        <a href="https://github.com/amanprojects" target="_blank" rel="noopener noreferrer" id="footer-github-link"
                           class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 hover:border-white/20 transition-all" aria-label="GitHub">
                            <i class="fa-brands fa-github text-base"></i>
                        </a>
                        <a href="https://youtube.com/@SafeBanda" target="_blank" rel="noopener noreferrer" id="footer-youtube-link"
                           class="w-9 h-9 rounded-lg bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400 hover:bg-red-500/20 hover:border-red-500/40 transition-all" aria-label="YouTube — SafeBanda">
                            <i class="fa-brands fa-youtube text-base"></i>
                        </a>
                        <a href="https://linkedin.com/company/amanprojects" target="_blank" rel="noopener noreferrer" id="footer-linkedin-link"
                           class="w-9 h-9 rounded-lg bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 hover:bg-blue-500/20 hover:border-blue-500/40 transition-all" aria-label="LinkedIn">
                            <i class="fa-brands fa-linkedin text-base"></i>
                        </a>
                        @if($data->profile?->phone)
                        <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener noreferrer" id="footer-whatsapp-link"
                           class="w-9 h-9 rounded-lg bg-green-500/10 border border-green-500/20 flex items-center justify-center text-green-400 hover:bg-green-500/20 hover:border-green-500/40 transition-all" aria-label="WhatsApp">
                            <i class="fa-brands fa-whatsapp text-base"></i>
                        </a>
                        @endif
                    @endif
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-grotesk font-semibold text-white mb-4 text-sm tracking-wide">Quick Links</h4>
                <ul class="flex flex-col gap-2.5">
                    @foreach([
                        ['#home', 'Home'],
                        ['#services', 'Services'],
                        ['#products', 'Products'],
                        ['#pricing', 'Pricing'],
                        ['#contact', 'Contact'],
                    ] as [$href, $label])
                    <li><a href="{{ $href }}" class="text-slate-400 text-sm hover:text-cyan-400 transition-colors hover:translate-x-1 inline-block">{{ $label }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="font-grotesk font-semibold text-white mb-4 text-sm tracking-wide">Services</h4>
                <ul class="flex flex-col gap-2.5">
                    @foreach([
                        'Web Development',
                        'SaaS Development',
                        'Security Audit',
                        'API Integration',
                        'Custom Software',
                    ] as $service)
                    <li><a href="#services" class="text-slate-400 text-sm hover:text-cyan-400 transition-colors">{{ $service }}</a></li>
                    @endforeach
                </ul>
            </div>

            {{-- Products --}}
            <div>
                <h4 class="font-grotesk font-semibold text-white mb-4 text-sm tracking-wide">Products</h4>
                <ul class="flex flex-col gap-2.5">
                    @foreach([
                        ['AP Coaching', 'Coaching SaaS'],
                        ['AP Library', 'Library Booking SaaS'],
                        ['CodeBB', 'Developer Community'],
                        ['SafeBanda', 'YouTube Channel'],
                    ] as [$name, $desc])
                    <li>
                        <a href="#products" class="text-slate-400 text-sm hover:text-cyan-400 transition-colors">
                            {{ $name }}
                            <span class="text-slate-600 text-xs block">{{ $desc }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Newsletter Strip --}}
        <div class="glass-card border border-cyan-500/10 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between gap-5 mb-10">
            <div>
                <h4 class="font-grotesk font-semibold text-white mb-1">Stay Updated</h4>
                <p class="text-slate-400 text-sm">Get the latest product updates and tech insights in your inbox.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <input type="email" placeholder="Enter your email" id="newsletter-email"
                    class="flex-1 md:w-60 px-4 py-2.5 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 transition-all" style="background:rgba(13,21,38,0.5);">
                <button id="newsletter-submit-btn" class="px-5 py-2.5 bg-gradient-to-r from-cyan-500 to-electric-500 text-white text-sm font-semibold rounded-xl btn-glow transition-all hover:scale-105 whitespace-nowrap">
                    Subscribe
                </button>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-white/5 pt-6 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-slate-500 text-sm text-center md:text-left">
                &copy; {{ date('Y') }} <span class="text-slate-400 font-medium">{{ $siteName }}</span>. All rights reserved.
            </p>
            <p class="text-slate-500 text-sm flex items-center gap-1">
                Made with
                <svg class="w-4 h-4 text-red-400 animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                in <span class="text-orange-400 font-medium">Saharsa, Bihar, India 🇮🇳</span>
            </p>
        </div>
    </div>
</footer>

@if($data->profile?->phone)
{{-- ======================================================
     FLOATING WHATSAPP BUTTON
====================================================== --}}
<a href="https://wa.me/{{ $cleanPhone }}?text=Hi%20{{ rawurlencode($siteName) }}!%20I%20have%20a%20project%20enquiry." target="_blank" rel="noopener noreferrer"
   id="floating-whatsapp-btn"
   class="fixed bottom-6 right-6 z-50 w-14 h-14 rounded-full bg-green-500 flex items-center justify-center shadow-2xl shadow-green-500/40 hover:scale-110 hover:shadow-green-500/60 transition-all"
   aria-label="Chat on WhatsApp">
    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    {{-- Pulse ring --}}
    <span class="absolute inset-0 rounded-full bg-green-400 animate-ping opacity-20"></span>
</a>
@endif

@endsection

@push('styles')
<style>
/* ============================================================
   HERO SWIPER — Navigation Buttons
   (Swiper ::after uses its own webfont; color via CSS var)
============================================================ */
.heroSwiper .swiper-button-prev,
.heroSwiper .swiper-button-next {
    width: 2.5rem !important;
    height: 2.5rem !important;
    border-radius: 9999px !important;
    background: rgba(10, 15, 30, 0.85) !important;
    border: 1px solid rgba(6, 182, 212, 0.3) !important;
    backdrop-filter: blur(8px) !important;
    -webkit-backdrop-filter: blur(8px) !important;
    box-shadow: 0 0 12px rgba(6, 182, 212, 0.15) !important;
    transition: all 0.25s ease !important;
    margin-top: -1.25rem !important; /* vertically center (half of h) */
}

.heroSwiper .swiper-button-prev:hover,
.heroSwiper .swiper-button-next:hover {
    background: rgba(6, 182, 212, 0.18) !important;
    border-color: rgba(6, 182, 212, 0.65) !important;
    box-shadow: 0 0 20px rgba(6, 182, 212, 0.35) !important;
    transform: scale(1.1) !important;
}

/* Arrow icon size is controlled via --swiper-navigation-size set inline */
.heroSwiper .swiper-button-prev::after,
.heroSwiper .swiper-button-next::after {
    font-size: 1rem !important;
    font-weight: 700 !important;
}

/* Pagination bullets */
.heroSwiper .swiper-pagination-bullet {
    background: rgba(6, 182, 212, 0.4) !important;
    opacity: 1 !important;
}
.heroSwiper .swiper-pagination-bullet-active {
    background: #06b6d4 !important;
    box-shadow: 0 0 6px rgba(6, 182, 212, 0.7) !important;
}
</style>
@endpush

@push('scripts')

<script>
// ============================================================
// HERO SWIPER
// ============================================================
const heroSwiper = new Swiper('.heroSwiper', {
    loop: true,
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    },
    effect: 'fade',
    fadeEffect: { crossFade: true },
    navigation: {
        nextEl: '.heroSwiper .swiper-button-next',
        prevEl: '.heroSwiper .swiper-button-prev',
    },
    pagination: {
        el: '.heroSwiper .swiper-pagination',
        clickable: true,
    },
});

// ============================================================
// TESTIMONIALS SWIPER
// ============================================================
const testimonialsSwiper = new Swiper('.testimonialsSwiper', {
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    slidesPerView: 1,
    spaceBetween: 24,
    breakpoints: {
        640: { slidesPerView: 1.5 },
        900: { slidesPerView: 2 },
        1200: { slidesPerView: 3 },
    },
    pagination: {
        el: '.testimonialsSwiper .swiper-pagination',
        clickable: true,
    },
    grabCursor: true,
});

// ============================================================
// STATS COUNTER ANIMATION (Intersection Observer)
// ============================================================
const counters = document.querySelectorAll('.counter-stat');

const countUp = (el) => {
    const target = parseInt(el.dataset.target, 10);
    const duration = 1800;
    const step = Math.ceil(target / (duration / 16));
    let current = 0;

    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        el.textContent = current;
    }, 16);
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting && !entry.target.dataset.counted) {
            entry.target.dataset.counted = 'true';
            countUp(entry.target);
        }
    });
}, { threshold: 0.5 });

counters.forEach(counter => observer.observe(counter));

// ============================================================
// NAVBAR SMOOTH SCROLL — close mobile on link click
// ============================================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        const target = document.querySelector(targetId);
        if (target) {
            e.preventDefault();
            const offset = 80;
            const top = target.getBoundingClientRect().top + window.scrollY - offset;
            window.scrollTo({ top, behavior: 'smooth' });
        }
    });
});

// ============================================================
// NEWSLETTER FORM — simple UX feedback
// ============================================================
const newsletterBtn = document.getElementById('newsletter-submit-btn');
if (newsletterBtn) {
    newsletterBtn.addEventListener('click', function() {
        const email = document.getElementById('newsletter-email').value.trim();
        if (!email || !email.includes('@')) {
            document.getElementById('newsletter-email').style.borderColor = 'rgba(239,68,68,0.6)';
            return;
        }
        newsletterBtn.textContent = '✓ Subscribed!';
        newsletterBtn.disabled = true;
        newsletterBtn.style.background = 'linear-gradient(135deg, #22c55e, #16a34a)';
    });
}

// ============================================================
// ACTIVE NAV HIGHLIGHT (optional scroll spy)
// ============================================================
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('nav a[href^="#"]');

window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop - 120;
        if (window.scrollY >= sectionTop) current = section.getAttribute('id');
    });
    navLinks.forEach(link => {
        link.classList.remove('text-cyan-400');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('text-cyan-400');
        }
    });
}, { passive: true });
</script>
@endpush
