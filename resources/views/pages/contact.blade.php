@extends('layouts.app')

@php
    $siteName = $data->settings['site_name'] ?? ($settings['site_name'] ?? 'AmanProjects');
    $metaDesc = $data->settings['meta_description'] ?? ($settings['meta_description'] ?? 'Contact AmanProjects in Saharsa, Bihar. Submit details for custom web development project estimation or security audits.');
    $profile = $data->profile ?? null;
    $user = $data->user ?? null;
    $cleanPhone = preg_replace('/[^0-9]/', '', $profile?->phone ?? '919876543210');
@endphp

@section('title', 'Contact Us | ' . $siteName)
@section('meta_description', $metaDesc)
@section('meta_keywords', $data->settings['meta_keywords'] ?? 'contact amanprojects, contact technical aman, software development bihar, software office saharsa')
@section('use_tailwind', true)

@push('styles')
{{-- Structured JSON-LD Data for SEO, GEO & AEO --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ContactPage",
      "@id": "{{ url('/contact') }}/#contactpage",
      "url": "{{ url('/contact') }}",
      "name": "Contact {{ $siteName }}",
      "description": "{{ addslashes($metaDesc) }}",
      "isPartOf": {
        "@type": "WebSite",
        "@id": "{{ url('/') }}/#website"
      },
      "breadcrumb": {
        "@type": "BreadcrumbList",
        "itemListElement": [
          {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ url('/') }}"
          },
          {
            "@type": "ListItem",
            "position": 2,
            "name": "Contact Us",
            "item": "{{ url('/contact') }}"
          }
        ]
      }
    },
    {
      "@type": "LocalBusiness",
      "@id": "{{ url('/') }}/#organization",
      "name": "{{ $siteName }}",
      "image": "{{ !empty($data->settings['logo']) ? asset($data->settings['logo']) : asset('assets/og-image.jpg') }}",
      "telephone": "{{ $profile->phone ?? '' }}",
      "email": "{{ $user->email ?? '' }}",
      "priceRange": "₹₹",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "{{ $profile->location ?? 'Saharsa, Bihar, India' }}",
        "addressLocality": "Saharsa",
        "addressRegion": "Bihar",
        "postalCode": "852201",
        "addressCountry": "IN"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": "25.0961",
        "longitude": "85.3131"
      },
      "openingHoursSpecification": [
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
          "opens": "09:00",
          "closes": "19:00"
        },
        {
          "@type": "OpeningHoursSpecification",
          "dayOfWeek": "Saturday",
          "opens": "10:00",
          "closes": "16:00"
        }
      ]
    }
  ]
}
</script>

<style>
    .page-header {
        padding: 8rem 0 4rem;
        background: linear-gradient(180deg, rgba(2, 8, 23, 0.9) 0%, rgba(10, 15, 30, 0.4) 100%);
    }
</style>
@endpush

@section('content')

@include('partials.nav')

{{-- ===== HEADER SECTION ===== --}}
<header class="page-header relative overflow-hidden">
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <div class="absolute top-10 left-10 w-64 h-64 bg-cyan-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-72 h-72 bg-indigo-500/5 rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 md:px-8 text-center relative z-10">
        <span class="inline-block text-cyan-400 text-sm font-semibold tracking-widest uppercase mb-3" data-aos="fade-down">Get In Touch</span>
        <h1 class="font-grotesk font-bold text-4xl sm:text-5xl lg:text-6xl text-white mb-6" data-aos="fade-up">
            Contact <span class="gradient-text">Us</span>
        </h1>
        <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="100">
            Have a project query or need a security audit? Send us a secure message or reach out directly.
        </p>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 md:px-8 py-16 relative z-10">

    <div class="grid lg:grid-cols-12 gap-12 mb-24">

        {{-- ===== LEFT: CONTACT INFO (5 Columns) ===== --}}
        <div class="lg:col-span-5 space-y-8" data-aos="fade-right">
            
            {{-- Info Cards --}}
            <div class="glass-card border border-white/5 p-7 space-y-6">
                <h2 class="font-grotesk font-bold text-xl text-white border-b border-white/5 pb-4">Contact Details</h2>

                {{-- Location --}}
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-cyan-500/10 flex items-center justify-center text-cyan-400 flex-shrink-0">
                        <i class="fa-solid fa-location-dot text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wide">Office Location</h3>
                        <p class="text-white text-base mt-1">{{ $profile->location ?? 'Saharsa, Bihar, India' }}</p>
                    </div>
                </div>

                {{-- Phone --}}
                @if(!empty($profile?->phone))
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-green-500/10 flex items-center justify-center text-green-400 flex-shrink-0">
                        <i class="fa-solid fa-phone text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wide">Telephone</h3>
                        <a href="tel:{{ $profile->phone }}" class="text-white hover:text-cyan-400 text-base mt-1 block transition-colors">{{ $profile->phone }}</a>
                    </div>
                </div>
                @endif

                {{-- Email --}}
                @if(!empty($user?->email))
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-400 flex-shrink-0">
                        <i class="fa-solid fa-envelope text-base"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wide">Official Email</h3>
                        <a href="mailto:{{ $user->email }}" class="text-white hover:text-cyan-400 text-base mt-1 block transition-colors">{{ $user->email }}</a>
                    </div>
                </div>
                @endif

                {{-- WhatsApp Link --}}
                @if(!empty($profile?->phone))
                <div class="pt-2 border-t border-white/5">
                    <a href="https://wa.me/{{ $cleanPhone }}" target="_blank" rel="noopener noreferrer" 
                       class="flex items-center justify-center gap-2 w-full py-3 bg-green-500/15 border border-green-500/30 text-green-400 font-semibold rounded-xl hover:bg-green-500/20 transition-all">
                        <i class="fa-brands fa-whatsapp text-lg"></i> Chat on WhatsApp
                    </a>
                </div>
                @endif
            </div>

            {{-- Business Hours --}}
            <div class="glass-card border border-white/5 p-7">
                <h2 class="font-grotesk font-bold text-xl text-white border-b border-white/5 pb-4 mb-4">Business Hours</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center text-slate-300">
                        <span>Monday - Friday</span>
                        <span class="text-white font-medium">9:00 AM - 7:00 PM IST</span>
                    </div>
                    <div class="flex justify-between items-center text-slate-300">
                        <span>Saturday</span>
                        <span class="text-white font-medium">10:00 AM - 4:00 PM IST</span>
                    </div>
                    <div class="flex justify-between items-center text-slate-300">
                        <span>Sunday</span>
                        <span class="text-red-400 font-semibold uppercase text-xs tracking-wider">Closed</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- ===== RIGHT: SECURE CONTACT FORM (7 Columns) ===== --}}
        <div class="lg:col-span-7" data-aos="fade-left" data-aos-delay="150">
            <div class="glass-card border border-white/5 p-8 relative">
                
                <h2 class="font-grotesk font-bold text-2xl text-white mb-6">Send Us a Secure Message</h2>

                <form action="{{ route('contact.store') }}" method="POST" id="contact-page-form" class="space-y-5">
                    @csrf
                    
                    {{-- Upgraded Deceptive Honeypot Bot Trap --}}
                    <div style="position: absolute; left: -9999px; height: 0; width: 0; overflow: hidden; z-index: -1;">
                        <input type="text" name="honeypot" tabindex="-1" autocomplete="off" placeholder="Do not fill this field">
                    </div>

                    {{-- Session Success Alert --}}
                    @if(session('success'))
                    <div class="p-4 rounded-xl bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 text-sm flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <div>
                            <span class="font-bold">Sent!</span> {{ session('success') }}
                        </div>
                    </div>
                    @endif

                    {{-- Throttling & Validation Error Alert --}}
                    @if ($errors->any())
                    <div class="p-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
                        <div class="flex items-center gap-2 mb-2 font-bold">
                            <i class="fa-solid fa-triangle-exclamation"></i> Submission Error
                        </div>
                        <ul class="list-disc list-inside space-y-1 text-xs text-red-300">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label for="page-contact-name" class="block text-slate-400 text-sm font-medium mb-2">Full Name *</label>
                            <input type="text" id="page-contact-name" name="name" required
                                placeholder="Your full name"
                                value="{{ old('name') }}"
                                class="w-full px-4 py-3 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 focus:ring-2 focus:ring-cyan-500/10 transition-all"
                                style="background: rgba(13,21,38,0.5);">
                            @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="page-contact-email" class="block text-slate-400 text-sm font-medium mb-2">Email Address *</label>
                            <input type="email" id="page-contact-email" name="email" required
                                placeholder="your@email.com"
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 focus:ring-2 focus:ring-cyan-500/10 transition-all"
                                style="background: rgba(13,21,38,0.5);">
                            @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="page-contact-subject" class="block text-slate-400 text-sm font-medium mb-2">Subject *</label>
                        <input type="text" id="page-contact-subject" name="subject" required
                            placeholder="What is this regarding?"
                            value="{{ old('subject') }}"
                            class="w-full px-4 py-3 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 focus:ring-2 focus:ring-cyan-500/10 transition-all"
                            style="background: rgba(13,21,38,0.5);">
                        @error('subject')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="page-contact-message" class="block text-slate-400 text-sm font-medium mb-2">Message *</label>
                        <textarea id="page-contact-message" name="message" rows="6" required
                            placeholder="Write your message..."
                            class="w-full px-4 py-3 bg-navy-800/50 border border-white/10 rounded-xl text-white placeholder-slate-600 text-sm focus:outline-none focus:border-cyan-500/60 focus:ring-2 focus:ring-cyan-500/10 transition-all resize-none"
                            style="background: rgba(13,21,38,0.5);">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-4 bg-gradient-to-r from-cyan-500 to-electric-500 text-white font-bold rounded-xl btn-glow transition-all hover:scale-[1.01] flex items-center justify-center gap-2 text-base">
                            <i class="fa-solid fa-paper-plane"></i> Send Message securely
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</main>

@include('partials.footer')

@endsection
