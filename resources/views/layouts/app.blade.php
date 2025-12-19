<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>@yield('title', $settings['site_title'] ?? 'Portfolio')</title>
    <meta name="title" content="@yield('title', $settings['site_title'] ?? 'Portfolio')">
    <meta name="description" content="{{ $settings['meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $settings['meta_keywords'] ?? '' }}">
    <meta name="author" content="{{ $user?->name ?? 'Portfolio Owner' }}">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', $settings['site_title'] ?? 'Portfolio')">
    <meta property="og:description" content="{{ $settings['meta_description'] ?? '' }}">
    <meta property="og:image" content="{{ asset('assets/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', $settings['site_title'] ?? 'Portfolio')">
    <meta property="twitter:description" content="{{ $settings['meta_description'] ?? '' }}">
    <meta property="twitter:image" content="{{ asset('assets/twitter-image.jpg') }}">

    <!-- Favicon -->
    @if(!empty($settings['favicon']))
        <link rel="icon" type="image/png" sizes="32x32" href="@fileUrl($settings['favicon'])">
    @else
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
    @endif
    <link rel="apple-touch-icon" href="{{ asset('assets/apple-touch-icon.png') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">

    <!-- Theme Color -->
    <meta name="theme-color" content="{{ $settings['primary_color'] ?? '#8b5cf6' }}">

    @stack('styles')
</head>
<body>
    <!-- Animated Background -->
    <div class="background-animation">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    @include('partials.nav')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/frontend.js') }}"></script>
    @stack('scripts')
</body>
</html>
