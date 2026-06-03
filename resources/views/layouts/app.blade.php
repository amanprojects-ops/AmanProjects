<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ===== PRIMARY META TAGS ===== --}}
    <title>@yield('title', $settings['site_title'] ?? 'AmanProjects — Software Solutions & Digital Services')</title>
    <meta name="title" content="@yield('title', $settings['site_title'] ?? 'AmanProjects — Software Solutions & Digital Services')">
    <meta name="description" content="@yield('meta_description', $settings['meta_description'] ?? 'AmanProjects builds premium custom software, SaaS products, and security solutions from Bihar, India.')">
    <meta name="keywords" content="@yield('meta_keywords', $settings['meta_keywords'] ?? 'software company, custom software, saas, laravel, web development, bihar, india, amanprojects')">
    <meta name="author" content="{{ $user->name ?? 'AmanProjects' }}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">

    {{-- ===== OPEN GRAPH ===== --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'AmanProjects — Software Solutions & Digital Services')">
    <meta property="og:description" content="@yield('meta_description', 'Custom Software, SaaS Products & Security Solutions from Bihar, India.')">
    <meta property="og:image" content="{{ asset('assets/og-image.jpg') }}">

    {{-- ===== TWITTER ===== --}}
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'AmanProjects — Software Solutions')">
    <meta property="twitter:description" content="@yield('meta_description', 'Custom Software, SaaS Products & Security Solutions from Bihar, India.')">
    <meta property="twitter:image" content="{{ asset('assets/twitter-image.jpg') }}">

    {{-- ===== FAVICON ===== --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/apple-touch-icon.png') }}">

    {{-- ===== GOOGLE FONTS — Space Grotesk + Inter ===== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- ===== TAILWIND CSS CDN ===== --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy': {
                            950: '#020817',
                            900: '#0a0f1e',
                            800: '#0d1526',
                            700: '#111827',
                            600: '#1a2440',
                        },
                        'cyan': {
                            400: '#22d3ee',
                            500: '#06b6d4',
                            600: '#0891b2',
                        },
                        'electric': {
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                        }
                    },
                    fontFamily: {
                        'grotesk': ['Space Grotesk', 'sans-serif'],
                        'inter': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        glow: {
                            '0%': { boxShadow: '0 0 5px #06b6d4, 0 0 10px #06b6d4' },
                            '100%': { boxShadow: '0 0 20px #06b6d4, 0 0 40px #06b6d4, 0 0 60px #06b6d4' },
                        }
                    },
                    backdropBlur: {
                        xs: '2px',
                    }
                }
            }
        }
    </script>

    {{-- ===== AOS — Animate On Scroll ===== --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    {{-- ===== SWIPER JS ===== --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    {{-- ===== FONT AWESOME ===== --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

    {{-- ===== LEGACY STYLES (for portfolio pages) ===== --}}
    @hasSection('use_tailwind')
    @else
        <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    @endif

    {{-- ===== CUSTOM GLOBAL STYLES ===== --}}
    <style>
        :root {
            --primary-bg: #0a0f1e;
            --card-bg: rgba(13, 21, 38, 0.7);
            --border-glass: rgba(6, 182, 212, 0.15);
            --accent-cyan: #06b6d4;
            --accent-blue: #0ea5e9;
            --text-muted: #94a3b8;
        }

        * { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            background-color: #0a0f1e;
            color: #e2e8f0;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* Glassmorphism utility */
        .glass-card {
            background: rgba(13, 21, 38, 0.6);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(6, 182, 212, 0.12);
            border-radius: 1rem;
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #06b6d4, #0ea5e9, #38bdf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Cyan glow button */
        .btn-glow {
            position: relative;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(6, 182, 212, 0.4);
            transition: all 0.3s ease;
        }
        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(6, 182, 212, 0.7), 0 0 60px rgba(6, 182, 212, 0.3);
            transform: translateY(-2px);
        }

        /* Card hover glow */
        .card-hover:hover {
            border-color: rgba(6, 182, 212, 0.5) !important;
            box-shadow: 0 0 25px rgba(6, 182, 212, 0.15), inset 0 0 25px rgba(6, 182, 212, 0.03);
            transform: translateY(-4px);
            transition: all 0.3s ease;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a0f1e; }
        ::-webkit-scrollbar-thumb { background: #06b6d4; border-radius: 3px; }

        /* Section divider gradient */
        .section-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #06b6d4, transparent);
        }

        /* Swiper custom arrows */
        .swiper-button-next, .swiper-button-prev {
            color: #06b6d4 !important;
        }
        .swiper-pagination-bullet-active {
            background: #06b6d4 !important;
        }
    </style>

    <meta name="theme-color" content="#0a0f1e">
    @stack('styles')
</head>
<body class="bg-navy-900 text-slate-200 font-inter antialiased">

    {{-- ===== ANIMATED BACKGROUND GRID ===== --}}
    <div class="fixed inset-0 z-0 pointer-events-none overflow-hidden">
        <div class="absolute inset-0" style="background-image: linear-gradient(rgba(6,182,212,0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(6,182,212,0.03) 1px, transparent 1px); background-size: 64px 64px;"></div>
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-cyan-500/5 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-electric-500/5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-cyan-400/3 rounded-full blur-2xl animate-float"></div>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="relative z-10">
        @yield('content')
    </div>

    {{-- ===== ALPINE JS ===== --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- ===== AOS JS ===== --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

    {{-- ===== SWIPER JS ===== --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- ===== LEGACY SCRIPTS (portfolio pages) ===== --}}
    @hasSection('use_tailwind')
    @else
        <script src="{{ asset('js/frontend.js') }}"></script>
    @endif

    {{-- ===== GLOBAL SCRIPTS ===== --}}
    <script>
        // Init AOS
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 800,
                easing: 'ease-out-cubic',
                once: true,
                offset: 80,
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
