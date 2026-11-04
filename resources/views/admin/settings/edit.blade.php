@extends('layouts.admin')

@section('title', 'System Manager')
@section('page_title', '<span>System</span> Manager')

@section('content')

{{-- System Manager Header --}}
<div class="system-manager-header mb-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
        <div>
            <h1 class="page-title mb-1" style="display:flex; align-items:center; gap:10px;">
                <span class="title-icon" style="background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);">
                    <i class="fa-solid fa-server text-white"></i>
                </span>
                System Manager
            </h1>
            <p class="text-muted mb-0" style="font-size:13.5px;">
                <i class="fa-solid fa-sliders text-indigo-500 me-1"></i>
                Centralized control for Website, Branding, SEO, Email SMTP, and Feature Modules.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <form action="{{ route('admin.settings.flush-cache') }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to flush all application caches, routes, and views?');">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm px-3 py-2" style="border-radius:8px; font-weight:600; display:flex; align-items:center; gap:6px;">
                    <i class="fa-solid fa-broom"></i> Flush All Cache
                </button>
            </form>

            <button type="submit" form="systemManagerForm" class="btn btn-primary btn-sm px-3 py-2" style="background:#6366f1; border-color:#6366f1; border-radius:8px; font-weight:600; display:flex; align-items:center; gap:6px;">
                <i class="fa-solid fa-floppy-disk"></i> Save Changes
            </button>
        </div>
    </div>
</div>

{{-- Navigation Tabs --}}
<div class="system-tabs-container mb-4">
    <ul class="nav nav-pills custom-system-pills" id="systemSettingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tab-general-btn" type="button" role="tab" onclick="setActiveTab('general')">
                <i class="fa-solid fa-globe"></i> General &amp; Info
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-branding-btn" type="button" role="tab" onclick="setActiveTab('branding')">
                <i class="fa-solid fa-palette"></i> Branding &amp; Assets
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-seo-btn" type="button" role="tab" onclick="setActiveTab('seo')">
                <i class="fa-solid fa-magnifying-glass-chart"></i> SEO &amp; Analytics
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-smtp-btn" type="button" role="tab" onclick="setActiveTab('smtp')">
                <i class="fa-solid fa-envelope-open-text"></i> Email &amp; SMTP
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-modules-btn" type="button" role="tab" onclick="setActiveTab('modules')">
                <i class="fa-solid fa-cubes"></i> Feature Modules
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tab-system-btn" type="button" role="tab" onclick="setActiveTab('system')">
                <i class="fa-solid fa-shield-halved"></i> Maintenance &amp; Diagnostics
            </button>
        </li>
    </ul>
</div>

{{-- Main Settings Form --}}
<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="systemManagerForm">
    @csrf
    @method('PUT')

    <input type="hidden" name="active_tab" id="active_tab_input" value="general">

    <div class="tab-content" id="systemSettingsTabsContent">

        {{-- =========================================================================
             TAB 1: GENERAL & SITE INFORMATION
        ========================================================================= --}}
        <div class="tab-pane fade show active" id="tab-general" role="tabpanel">
            <div class="row g-4">
                {{-- Site Identity --}}
                <div class="col-lg-7">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-globe text-primary"></i> Site Identity &amp; Meta Titles</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:16px;">
                            <div>
                                <label for="site_name" class="form-label-custom">Site Name</label>
                                <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name']) }}" class="form-control-custom" placeholder="e.g. AmanProjects">
                                <small class="text-muted" style="font-size:12px;">Used in navigation brand, footer, and automated emails.</small>
                            </div>

                            <div>
                                <label for="site_title" class="form-label-custom">Default Browser Title (SEO)</label>
                                <input type="text" name="site_title" id="site_title" value="{{ old('site_title', $settings['site_title']) }}" class="form-control-custom" placeholder="e.g. AmanProjects | Custom Software & Web Development">
                            </div>

                            <div>
                                <label for="site_tagline" class="form-label-custom">Tagline / Slogan</label>
                                <input type="text" name="site_tagline" id="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}" class="form-control-custom" placeholder="e.g. Innovating Digital Solutions & Web Platforms">
                            </div>

                            <div>
                                <label for="site_copyright" class="form-label-custom">Footer Copyright Text</label>
                                <input type="text" name="site_copyright" id="site_copyright" value="{{ old('site_copyright', $settings['site_copyright']) }}" class="form-control-custom" placeholder="e.g. © {{ date('Y') }} AmanProjects. All rights reserved.">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Channels & Coordinates --}}
                <div class="col-lg-5">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-address-book text-primary"></i> Contact Channels</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:16px;">
                            <div>
                                <label for="local_business_email" class="form-label-custom">Primary Contact Email</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:#f8fafc; border-color:#e2e8f0;"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input type="email" name="local_business_email" id="local_business_email" value="{{ old('local_business_email', $settings['local_business_email']) }}" class="form-control-custom" placeholder="contact@amanprojects.com">
                                </div>
                            </div>

                            <div>
                                <label for="local_business_phone" class="form-label-custom">Contact Phone Number</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:#f8fafc; border-color:#e2e8f0;"><i class="fa-solid fa-phone text-muted"></i></span>
                                    <input type="text" name="local_business_phone" id="local_business_phone" value="{{ old('local_business_phone', $settings['local_business_phone']) }}" class="form-control-custom" placeholder="+91 9876543210">
                                </div>
                            </div>

                            <div>
                                <label for="whatsapp_number" class="form-label-custom">WhatsApp Direct Number</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:#f8fafc; border-color:#e2e8f0;"><i class="fa-brands fa-whatsapp text-success"></i></span>
                                    <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" class="form-control-custom" placeholder="+919876543210">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-map-location-dot text-primary"></i> Physical Location &amp; Geo Coordinates</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:14px;">
                            <div>
                                <label for="local_business_address" class="form-label-custom">Full Business Address</label>
                                <textarea name="local_business_address" id="local_business_address" rows="2" class="form-control-custom" placeholder="Street Address, Landmark...">{{ old('local_business_address', $settings['local_business_address']) }}</textarea>
                            </div>

                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                                <div>
                                    <label for="local_business_locality" class="form-label-custom">City / Locality</label>
                                    <input type="text" name="local_business_locality" id="local_business_locality" value="{{ old('local_business_locality', $settings['local_business_locality']) }}" class="form-control-custom" placeholder="Saharsa">
                                </div>
                                <div>
                                    <label for="local_business_region" class="form-label-custom">State / Region</label>
                                    <input type="text" name="local_business_region" id="local_business_region" value="{{ old('local_business_region', $settings['local_business_region']) }}" class="form-control-custom" placeholder="Bihar">
                                </div>
                            </div>

                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                                <div>
                                    <label for="local_business_postal_code" class="form-label-custom">Postal Code</label>
                                    <input type="text" name="local_business_postal_code" id="local_business_postal_code" value="{{ old('local_business_postal_code', $settings['local_business_postal_code']) }}" class="form-control-custom" placeholder="852201">
                                </div>
                                <div>
                                    <label for="local_business_country" class="form-label-custom">Country</label>
                                    <input type="text" name="local_business_country" id="local_business_country" value="{{ old('local_business_country', $settings['local_business_country']) }}" class="form-control-custom" placeholder="India">
                                </div>
                            </div>

                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                                <div>
                                    <label for="local_business_lat" class="form-label-custom">Latitude (GPS)</label>
                                    <input type="text" name="local_business_lat" id="local_business_lat" value="{{ old('local_business_lat', $settings['local_business_lat']) }}" class="form-control-custom" placeholder="25.0961">
                                </div>
                                <div>
                                    <label for="local_business_lng" class="form-label-custom">Longitude (GPS)</label>
                                    <input type="text" name="local_business_lng" id="local_business_lng" value="{{ old('local_business_lng', $settings['local_business_lng']) }}" class="form-control-custom" placeholder="85.3131">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================================================================
             TAB 2: BRANDING & ASSETS (#branding)
        ========================================================================= --}}
        <div class="tab-pane fade" id="tab-branding" role="tabpanel">
            <div class="row g-4">
                {{-- Logos & Icons --}}
                <div class="col-lg-8">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-image text-primary"></i> Logos &amp; Identity Assets</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:20px;">
                            
                            {{-- Header Logo --}}
                            <div class="p-3 bg-light rounded-3 border">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label-custom mb-0 font-bold">Header Main Logo (PNG, SVG, WebP)</label>
                                    <span class="badge bg-secondary">Recommended height: 40px–50px</span>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-sm-4 text-center mb-2 mb-sm-0">
                                        <div class="preview-box p-2 bg-dark rounded text-center" style="min-height:75px; display:flex; align-items:center; justify-content:center;">
                                            @if(!empty($settings['logo']))
                                                <img src="@fileUrl($settings['logo'])" alt="Main Logo" id="preview_logo" style="max-height:50px; max-width:100%; object-fit:contain; display:inline-block;">
                                                <span class="text-white-50" style="font-size:12px; display:none;" id="preview_logo_placeholder"><i class="fa-solid fa-image fa-2x d-block mb-1"></i> No Logo</span>
                                            @else
                                                <span class="text-white-50" style="font-size:12px; display:inline-block;" id="preview_logo_placeholder"><i class="fa-solid fa-image fa-2x d-block mb-1"></i> No Logo</span>
                                                <img src="" alt="Main Logo" id="preview_logo" style="max-height:50px; max-width:100%; object-fit:contain; display:none;">
                                            @endif
                                        </div>
                                        @if(!empty($settings['logo']))
                                            <div class="form-check mt-2 text-start">
                                                <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="remove_logo">
                                                <label class="form-check-label text-danger" for="remove_logo" style="font-size:12px; font-weight:600; cursor:pointer;">
                                                    <i class="fa-solid fa-trash me-1"></i> Remove Logo
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="file" name="logo" id="input_logo" class="form-control" accept="image/*,.svg" onchange="previewImage(this, 'preview_logo', 'preview_logo_placeholder')">
                                        <small class="text-muted d-block mt-1">Displayed in website navigation bar &amp; admin sidebar.</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Dark / Alternative Logo --}}
                            <div class="p-3 bg-light rounded-3 border">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label-custom mb-0 font-bold">Dark / Alternative Logo (Optional)</label>
                                    <span class="badge bg-secondary">For light backgrounds</span>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-sm-4 text-center mb-2 mb-sm-0">
                                        <div class="preview-box p-2 bg-white rounded text-center border" style="min-height:75px; display:flex; align-items:center; justify-content:center;">
                                            @if(!empty($settings['logo_dark']))
                                                <img src="@fileUrl($settings['logo_dark'])" alt="Dark Logo" id="preview_logo_dark" style="max-height:50px; max-width:100%; object-fit:contain; display:inline-block;">
                                                <span class="text-muted" style="font-size:12px; display:none;" id="preview_logo_dark_placeholder"><i class="fa-solid fa-image fa-2x d-block mb-1"></i> No Dark Logo</span>
                                            @else
                                                <span class="text-muted" style="font-size:12px; display:inline-block;" id="preview_logo_dark_placeholder"><i class="fa-solid fa-image fa-2x d-block mb-1"></i> No Dark Logo</span>
                                                <img src="" alt="Dark Logo" id="preview_logo_dark" style="max-height:50px; max-width:100%; object-fit:contain; display:none;">
                                            @endif
                                        </div>
                                        @if(!empty($settings['logo_dark']))
                                            <div class="form-check mt-2 text-start">
                                                <input class="form-check-input" type="checkbox" name="remove_logo_dark" value="1" id="remove_logo_dark">
                                                <label class="form-check-label text-danger" for="remove_logo_dark" style="font-size:12px; font-weight:600; cursor:pointer;">
                                                    <i class="fa-solid fa-trash me-1"></i> Remove Dark Logo
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="file" name="logo_dark" id="input_logo_dark" class="form-control" accept="image/*,.svg" onchange="previewImage(this, 'preview_logo_dark', 'preview_logo_dark_placeholder')">
                                        <small class="text-muted d-block mt-1">Used when rendering on light sections or PDF exports.</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Favicon & Apple Touch Icon --}}
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border h-100">
                                        <label class="form-label-custom mb-1 font-bold">Browser Favicon (.ico, .png)</label>
                                        <div class="d-flex align-items-center gap-3 my-2">
                                            <div class="p-2 bg-white rounded border text-center" style="width:52px; height:52px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                                @if(!empty($settings['favicon']))
                                                    <img src="@fileUrl($settings['favicon'])" alt="Favicon" id="preview_favicon" style="width:32px; height:32px; object-fit:contain; display:inline-block;">
                                                    <span class="text-muted" id="preview_favicon_placeholder" style="display:none;"><i class="fa-solid fa-globe fa-lg"></i></span>
                                                @else
                                                    <span class="text-muted" id="preview_favicon_placeholder" style="display:inline-block;"><i class="fa-solid fa-globe fa-lg"></i></span>
                                                    <img src="" alt="Favicon" id="preview_favicon" style="width:32px; height:32px; object-fit:contain; display:none;">
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <input type="file" name="favicon" class="form-control form-control-sm" accept=".ico,.png,image/x-icon,image/png" onchange="previewImage(this, 'preview_favicon', 'preview_favicon_placeholder')">
                                            </div>
                                        </div>
                                        @if(!empty($settings['favicon']))
                                            <div class="form-check mt-1">
                                                <input class="form-check-input" type="checkbox" name="remove_favicon" value="1" id="remove_favicon">
                                                <label class="form-check-label text-danger" for="remove_favicon" style="font-size:12px; cursor:pointer;">Remove Favicon</label>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-3 bg-light rounded-3 border h-100">
                                        <label class="form-label-custom mb-1 font-bold">Apple Touch Icon (180x180 png)</label>
                                        <div class="d-flex align-items-center gap-3 my-2">
                                            <div class="p-2 bg-white rounded border text-center" style="width:52px; height:52px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                                @if(!empty($settings['apple_touch_icon']))
                                                    <img src="@fileUrl($settings['apple_touch_icon'])" alt="Apple Touch Icon" id="preview_apple_touch_icon" style="width:36px; height:36px; object-fit:contain; display:inline-block;">
                                                    <span class="text-muted" id="preview_apple_touch_placeholder" style="display:none;"><i class="fa-brands fa-apple fa-xl"></i></span>
                                                @else
                                                    <span class="text-muted" id="preview_apple_touch_placeholder" style="display:inline-block;"><i class="fa-brands fa-apple fa-xl"></i></span>
                                                    <img src="" alt="Apple Touch Icon" id="preview_apple_touch_icon" style="width:36px; height:36px; object-fit:contain; display:none;">
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <input type="file" name="apple_touch_icon" class="form-control form-control-sm" accept="image/png,image/jpeg,image/webp" onchange="previewImage(this, 'preview_apple_touch_icon', 'preview_apple_touch_placeholder')">
                                            </div>
                                        </div>
                                        @if(!empty($settings['apple_touch_icon']))
                                            <div class="form-check mt-1">
                                                <input class="form-check-input" type="checkbox" name="remove_apple_touch_icon" value="1" id="remove_apple_touch_icon">
                                                <label class="form-check-label text-danger" for="remove_apple_touch_icon" style="font-size:12px; cursor:pointer;">Remove Apple Icon</label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Color Theme & Social Card Banner --}}
                <div class="col-lg-4">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-palette text-primary"></i> Theme Colors</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:16px;">
                            <div>
                                <label for="primary_color" class="form-label-custom">Primary Accent Color</label>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="color" name="primary_color" id="primary_color" value="{{ old('primary_color', $settings['primary_color'] ?? '#3b82f6') }}" class="form-control form-control-color" style="width:48px; height:40px; cursor:pointer; flex-shrink:0;" oninput="syncColorInput('primary', this.value)">
                                    <input type="text" id="primary_hex" value="{{ old('primary_color', $settings['primary_color'] ?? '#3b82f6') }}" class="form-control-custom font-monospace" placeholder="#3b82f6" oninput="syncColorHex('primary', this.value)">
                                </div>
                            </div>

                            <div>
                                <label for="secondary_color" class="form-label-custom">Secondary Accent Color</label>
                                <div class="d-flex align-items-center gap-2">
                                    <input type="color" name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $settings['secondary_color'] ?? '#1e40af') }}" class="form-control form-control-color" style="width:48px; height:40px; cursor:pointer; flex-shrink:0;" oninput="syncColorInput('secondary', this.value)">
                                    <input type="text" id="secondary_hex" value="{{ old('secondary_color', $settings['secondary_color'] ?? '#1e40af') }}" class="form-control-custom font-monospace" placeholder="#1e40af" oninput="syncColorHex('secondary', this.value)">
                                </div>
                            </div>

                            {{-- Live Gradient Demo --}}
                            <div>
                                <label class="form-label-custom">Live Brand Gradient Preview</label>
                                <div id="gradientPreviewBox" class="p-3 text-center text-white rounded-3 shadow-sm font-bold" style="background: linear-gradient(135deg, {{ $settings['primary_color'] ?? '#3b82f6' }}, {{ $settings['secondary_color'] ?? '#1e40af' }}); min-height:65px; display:flex; align-items:center; justify-content:center; font-size:15px; letter-spacing:0.5px; transition:background 0.2s ease;">
                                    <span id="gradientPreviewText">{{ $settings['site_name'] ?: 'AmanProjects' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Open Graph Default Share Banner --}}
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-share-nodes text-primary"></i> Social Share Banner (1200x630)</h3>
                        </div>
                        <div class="form-section-body">
                            <div class="preview-box p-2 bg-dark rounded text-center mb-2" style="min-height:115px; display:flex; align-items:center; justify-content:center;">
                                @if(!empty($settings['og_image']))
                                    <img src="@fileUrl($settings['og_image'])" alt="Social Share Image" id="preview_og_image" style="max-height:100px; max-width:100%; object-fit:contain; border-radius:6px; display:inline-block;">
                                    <span class="text-white-50" id="preview_og_placeholder" style="font-size:12px; display:none;"><i class="fa-solid fa-image fa-2x d-block mb-1"></i> No Custom Banner</span>
                                @else
                                    <span class="text-white-50" id="preview_og_placeholder" style="font-size:12px; display:inline-block;"><i class="fa-solid fa-image fa-2x d-block mb-1"></i> No Custom Banner</span>
                                    <img src="" alt="Social Share Image" id="preview_og_image" style="max-height:100px; max-width:100%; object-fit:contain; display:none;">
                                @endif
                            </div>
                            <input type="file" name="og_image" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'preview_og_image', 'preview_og_placeholder')">
                            @if(!empty($settings['og_image']))
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_og_image" value="1" id="remove_og_image">
                                    <label class="form-check-label text-danger" for="remove_og_image" style="font-size:12px; cursor:pointer;">Remove Custom OG Banner</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================================================================
             TAB 3: SEO & ANALYTICS
        ========================================================================= --}}
        <div class="tab-pane fade" id="tab-seo" role="tabpanel">
            <div class="row g-4">
                {{-- Meta SEO & Preview --}}
                <div class="col-lg-7">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-magnifying-glass text-primary"></i> Search Engine Optimization (SEO)</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:16px;">
                            
                            {{-- SERP Simulator Preview Card --}}
                            <div class="p-3 bg-white border rounded-3 shadow-sm">
                                <span class="badge bg-light text-dark border mb-2"><i class="fa-brands fa-google text-primary"></i> Google Search SERP Preview</span>
                                <div style="font-family: Arial, sans-serif;">
                                    <div class="text-muted" style="font-size:12px;" id="serpUrlPreview">{{ url('/') }}</div>
                                    <div class="text-primary font-bold" style="font-size:17px; cursor:pointer; text-decoration:none;" id="serpTitlePreview">
                                        {{ $settings['site_title'] ?: 'AmanProjects' }}
                                    </div>
                                    <div class="text-secondary" style="font-size:13px; line-height:1.4;" id="serpDescPreview">
                                        {{ $settings['meta_description'] ?: 'Custom Software & Web Development in Saharsa, Bihar.' }}
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label for="meta_description" class="form-label-custom mb-0">Meta Description</label>
                                    <span class="badge bg-light text-secondary border" id="metaDescCounter">0 / 160 Recommended</span>
                                </div>
                                <textarea name="meta_description" id="meta_description" rows="3" class="form-control-custom" style="resize:vertical;" placeholder="Summarize your website concisely for search engine results…" oninput="updateSerpPreview()">{{ old('meta_description', $settings['meta_description']) }}</textarea>
                            </div>

                            <div>
                                <label for="meta_keywords" class="form-label-custom">Meta Keywords</label>
                                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords']) }}" class="form-control-custom" placeholder="software company, laravel, web development, bihar, amanprojects">
                                <small class="text-muted" style="font-size:12px;">Comma-separated keywords for search indexers.</small>
                            </div>

                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                                <div>
                                    <label for="meta_author" class="form-label-custom">Meta Author</label>
                                    <input type="text" name="meta_author" id="meta_author" value="{{ old('meta_author', $settings['meta_author']) }}" class="form-control-custom" placeholder="AmanProjects">
                                </div>
                                <div>
                                    <label for="meta_robots" class="form-label-custom">Robots Directive</label>
                                    <select name="meta_robots" id="meta_robots" class="form-control-custom">
                                        <option value="index, follow, max-snippet:-1, max-image-preview:large" {{ old('meta_robots', $settings['meta_robots']) === 'index, follow, max-snippet:-1, max-image-preview:large' ? 'selected' : '' }}>Index, Follow (Recommended)</option>
                                        <option value="index, nofollow" {{ old('meta_robots', $settings['meta_robots']) === 'index, nofollow' ? 'selected' : '' }}>Index, No Follow</option>
                                        <option value="noindex, follow" {{ old('meta_robots', $settings['meta_robots']) === 'noindex, follow' ? 'selected' : '' }}>No Index, Follow</option>
                                        <option value="noindex, nofollow" {{ old('meta_robots', $settings['meta_robots']) === 'noindex, nofollow' ? 'selected' : '' }}>No Index, No Follow (Private)</option>
                                    </select>
                                </div>
                            </div>

                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                                <div>
                                    <label for="og_title" class="form-label-custom">Open Graph Custom Title (Optional)</label>
                                    <input type="text" name="og_title" id="og_title" value="{{ old('og_title', $settings['og_title']) }}" class="form-control-custom" placeholder="Leave empty to use Site Title">
                                </div>
                                <div>
                                    <label for="twitter_card_type" class="form-label-custom">Twitter Card Format</label>
                                    <select name="twitter_card_type" id="twitter_card_type" class="form-control-custom">
                                        <option value="summary_large_image" {{ old('twitter_card_type', $settings['twitter_card_type']) === 'summary_large_image' ? 'selected' : '' }}>Summary Large Image (Recommended)</option>
                                        <option value="summary" {{ old('twitter_card_type', $settings['twitter_card_type']) === 'summary' ? 'selected' : '' }}>Standard Summary</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="twitter_creator" class="form-label-custom">Twitter / X Handle</label>
                                <input type="text" name="twitter_creator" id="twitter_creator" value="{{ old('twitter_creator', $settings['twitter_creator']) }}" class="form-control-custom" placeholder="@AmanProjects">
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Webmaster Verification, Analytics & Scripts --}}
                <div class="col-lg-5">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-chart-line text-primary"></i> Analytics &amp; Webmasters</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:14px;">
                            <div>
                                <label for="google_analytics_id" class="form-label-custom">Google Analytics 4 (GA4 ID)</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:#f8fafc; border-color:#e2e8f0;"><i class="fa-brands fa-google text-danger"></i></span>
                                    <input type="text" name="google_analytics_id" id="google_analytics_id" value="{{ old('google_analytics_id', $settings['google_analytics_id']) }}" class="form-control-custom" placeholder="G-XXXXXXXXXX">
                                </div>
                                <small class="text-muted" style="font-size:12px;">Auto-injected into head when set.</small>
                            </div>

                            <div>
                                <label for="google_tag_manager_id" class="form-label-custom">Google Tag Manager (GTM ID)</label>
                                <div class="input-group">
                                    <span class="input-group-text" style="background:#f8fafc; border-color:#e2e8f0;"><i class="fa-solid fa-tags text-primary"></i></span>
                                    <input type="text" name="google_tag_manager_id" id="google_tag_manager_id" value="{{ old('google_tag_manager_id', $settings['google_tag_manager_id']) }}" class="form-control-custom" placeholder="GTM-XXXXXXX">
                                </div>
                            </div>

                            <div>
                                <label for="google_site_verification" class="form-label-custom">Google Search Console Verification Token</label>
                                <input type="text" name="google_site_verification" id="google_site_verification" value="{{ old('google_site_verification', $settings['google_site_verification']) }}" class="form-control-custom" placeholder="e.g. abcd_1234_XYZ...">
                            </div>

                            <div>
                                <label for="bing_site_verification" class="form-label-custom">Bing Webmaster Verification Token</label>
                                <input type="text" name="bing_site_verification" id="bing_site_verification" value="{{ old('bing_site_verification', $settings['bing_site_verification']) }}" class="form-control-custom" placeholder="e.g. 1234567890ABCDEF...">
                            </div>
                        </div>
                    </div>

                    {{-- Custom Head & Footer Code --}}
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-code text-primary"></i> Custom Scripts &amp; Tracking Codes</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:14px;">
                            <div>
                                <label for="custom_head_scripts" class="form-label-custom">Custom &lt;head&gt; Scripts / CSS</label>
                                <textarea name="custom_head_scripts" id="custom_head_scripts" rows="3" class="form-control-custom font-monospace" style="font-size:12.5px;" placeholder="<script>...</script> or <style>...">{{ old('custom_head_scripts', $settings['custom_head_scripts']) }}</textarea>
                                <small class="text-muted" style="font-size:11.5px;">Injected right before closing &lt;/head&gt;.</small>
                            </div>

                            <div>
                                <label for="custom_footer_scripts" class="form-label-custom">Custom Footer &lt;/body&gt; Scripts</label>
                                <textarea name="custom_footer_scripts" id="custom_footer_scripts" rows="3" class="form-control-custom font-monospace" style="font-size:12.5px;" placeholder="<script>...</script>">{{ old('custom_footer_scripts', $settings['custom_footer_scripts']) }}</textarea>
                                <small class="text-muted" style="font-size:11.5px;">Injected before closing &lt;/body&gt; (chat widgets, pixels, etc.).</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================================================================
             TAB 4: EMAIL & SMTP
        ========================================================================= --}}
        <div class="tab-pane fade" id="tab-smtp" role="tabpanel">
            <div class="row g-4">
                {{-- SMTP Configuration --}}
                <div class="col-lg-7">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-at text-primary"></i> Email Protocol &amp; SMTP Credentials</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:16px;">
                            
                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                                <div>
                                    <label for="mail_mailer" class="form-label-custom">Mail Driver / Mailer</label>
                                    <select name="mail_mailer" id="mail_mailer" class="form-control-custom">
                                        <option value="smtp" {{ old('mail_mailer', $settings['mail_mailer']) === 'smtp' ? 'selected' : '' }}>SMTP (Recommended)</option>
                                        <option value="sendmail" {{ old('mail_mailer', $settings['mail_mailer']) === 'sendmail' ? 'selected' : '' }}>Sendmail (Server)</option>
                                        <option value="log" {{ old('mail_mailer', $settings['mail_mailer']) === 'log' ? 'selected' : '' }}>Log (Local Debugging)</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="mail_encryption" class="form-label-custom">Encryption Protocol</label>
                                    <select name="mail_encryption" id="mail_encryption" class="form-control-custom">
                                        <option value="tls" {{ old('mail_encryption', $settings['mail_encryption']) === 'tls' ? 'selected' : '' }}>TLS (Port 587)</option>
                                        <option value="ssl" {{ old('mail_encryption', $settings['mail_encryption']) === 'ssl' ? 'selected' : '' }}>SSL (Port 465)</option>
                                        <option value="none" {{ old('mail_encryption', $settings['mail_encryption']) === 'none' ? 'selected' : '' }}>None (Port 25)</option>
                                    </select>
                                </div>
                            </div>

                            <div style="display:grid; grid-template-columns:2fr 1fr; gap:12px;">
                                <div>
                                    <label for="mail_host" class="form-label-custom">SMTP Host</label>
                                    <input type="text" name="mail_host" id="mail_host" value="{{ old('mail_host', $settings['mail_host']) }}" class="form-control-custom" placeholder="e.g. smtp.gmail.com or smtp.mailtrap.io">
                                </div>
                                <div>
                                    <label for="mail_port" class="form-label-custom">SMTP Port</label>
                                    <input type="number" name="mail_port" id="mail_port" value="{{ old('mail_port', $settings['mail_port']) }}" class="form-control-custom" placeholder="587">
                                </div>
                            </div>

                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                                <div>
                                    <label for="mail_username" class="form-label-custom">SMTP Username / Email</label>
                                    <input type="text" name="mail_username" id="mail_username" value="{{ old('mail_username', $settings['mail_username']) }}" class="form-control-custom" placeholder="your-email@domain.com">
                                </div>
                                <div>
                                    <label for="mail_password" class="form-label-custom">SMTP Password / App Key</label>
                                    <div class="input-group">
                                        <input type="password" name="mail_password" id="mail_password" value="{{ old('mail_password', $settings['mail_password']) }}" class="form-control-custom" placeholder="••••••••••••">
                                        <button class="btn btn-outline-secondary" type="button" onclick="togglePasswordVisibility('mail_password', this)" style="border-color:#e2e8f0; background:#f8fafc;">
                                            <i class="fa-solid fa-eye text-muted"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                                <div>
                                    <label for="mail_from_address" class="form-label-custom">Default "From" Address</label>
                                    <input type="email" name="mail_from_address" id="mail_from_address" value="{{ old('mail_from_address', $settings['mail_from_address']) }}" class="form-control-custom" placeholder="noreply@amanprojects.com">
                                </div>
                                <div>
                                    <label for="mail_from_name" class="form-label-custom">Default "From" Sender Name</label>
                                    <input type="text" name="mail_from_name" id="mail_from_name" value="{{ old('mail_from_name', $settings['mail_from_name']) }}" class="form-control-custom" placeholder="AmanProjects">
                                </div>
                            </div>

                            {{-- Admin Notifications Toggle --}}
                            <div class="switch-wrapper mt-2" style="background:#f8fafc; border-radius:10px; border:1px solid #e2e8f0; padding:12px 16px; display:flex; align-items:center; gap:12px;">
                                <input type="hidden" name="mail_enable_notifications" value="0">
                                <input type="checkbox" name="mail_enable_notifications" value="1" id="mail_enable_notifications"
                                    {{ old('mail_enable_notifications', $settings['mail_enable_notifications'] ?? true) ? 'checked' : '' }}
                                    style="accent-color:#6366f1; width:20px; height:20px; cursor:pointer;">
                                <div>
                                    <label for="mail_enable_notifications" class="switch-label mb-0" style="font-weight:600; cursor:pointer; color:#1e293b;">
                                        Send Email Notification on New Contact Message
                                    </label>
                                    <p class="text-muted mb-0" style="font-size:12px;">Automatically dispatch an email to Business Email when visitors submit the contact form.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Interactive Live SMTP Tester --}}
                <div class="col-lg-5">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-paper-plane text-success"></i> Instant SMTP Test Tool</h3>
                        </div>
                        <div class="form-section-body">
                            <p class="text-muted" style="font-size:13px;">
                                Verify your SMTP host, credentials, port, and firewall connectivity by sending a real test email immediately.
                            </p>

                            <div class="mb-3">
                                <label for="test_email_recipient" class="form-label-custom">Recipient Email Address</label>
                                <input type="email" id="test_email_recipient" value="{{ old('local_business_email', $settings['local_business_email'] ?: auth()->user()->email) }}" class="form-control-custom" placeholder="admin@domain.com">
                            </div>

                            <button type="button" id="btnSendTestEmail" class="btn btn-success w-100 py-2.5 font-bold" style="border-radius:8px; display:flex; align-items:center; justify-content:center; gap:8px;" onclick="runSmtpTest()">
                                <i class="fa-solid fa-paper-plane"></i> Send Test Email Now
                            </button>

                            {{-- Live Result Feedback Box --}}
                            <div id="smtpTestResultBox" class="mt-3 p-3 rounded-3" style="display:none; font-size:13px;"></div>
                        </div>
                    </div>

                    {{-- Common SMTP Guides Card --}}
                    <div class="p-3 bg-light rounded-3 border">
                        <h6 class="font-bold mb-2 text-dark"><i class="fa-solid fa-circle-info text-info me-1"></i> Popular SMTP Configurations</h6>
                        <ul class="mb-0 ps-3 text-muted" style="font-size:12.5px; line-height:1.6;">
                            <li><strong>Gmail:</strong> <code>smtp.gmail.com</code> | Port: <code>587 (TLS)</code> or <code>465 (SSL)</code> (Use 16-digit Google App Password).</li>
                            <li><strong>Mailtrap:</strong> <code>sandbox.smtp.mailtrap.io</code> | Port: <code>2525</code> or <code>587</code>.</li>
                            <li><strong>SendGrid:</strong> <code>smtp.sendgrid.net</code> | Port: <code>587</code> | User: <code>apikey</code>.</li>
                            <li><strong>Zoho Mail:</strong> <code>smtppro.zoho.in</code> | Port: <code>465 (SSL)</code> or <code>587 (TLS)</code>.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- =========================================================================
             TAB 5: FEATURE & SECTION MODULES
        ========================================================================= --}}
        <div class="tab-pane fade" id="tab-modules" role="tabpanel">
            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-cubes text-primary"></i> Public Homepage Feature Modules</h3>
                </div>
                <div class="form-section-body">
                    <p class="text-muted mb-4" style="font-size:13.5px;">
                        Instantly enable or disable sections on your public website and navigation menu.
                    </p>

                    @php
                        $modulesList = [
                            'about'         => ['name' => 'About Us Section', 'desc' => 'Founder bio, education, experience, and journey overview.', 'icon' => 'fa-user-tie', 'color' => '#6366f1'],
                            'services'      => ['name' => 'Services Catalog', 'desc' => 'List of digital services, custom software, and features.', 'icon' => 'fa-laptop-code', 'color' => '#06b6d4'],
                            'projects'      => ['name' => 'Projects & Portfolio', 'desc' => 'Featured applications, live demo links, and screenshot albums.', 'icon' => 'fa-diagram-project', 'color' => '#10b981'],
                            'skills'        => ['name' => 'Technical Skills', 'desc' => 'Skill bars, frameworks, backend & frontend capabilities.', 'icon' => 'fa-code', 'color' => '#8b5cf6'],
                            'stats'         => ['name' => 'Statistics Counters', 'desc' => 'Key metrics, project delivery counts, and satisfaction counters.', 'icon' => 'fa-chart-pie', 'color' => '#f59e0b'],
                            'pricing'       => ['name' => 'Pricing Plans', 'desc' => 'Transparent subscription & project tiers with feature lists.', 'icon' => 'fa-tags', 'color' => '#ec4899'],
                            'testimonials'  => ['name' => 'Client Testimonials', 'desc' => 'Ratings, client reviews, and feedback carousel.', 'icon' => 'fa-comments', 'color' => '#3b82f6'],
                            'why_us'        => ['name' => 'Why Choose Us', 'desc' => 'Key value propositions and enterprise competitive advantages.', 'icon' => 'fa-award', 'color' => '#14b8a6'],
                            'how_we_work'   => ['name' => 'How We Work Process', 'desc' => 'Step-by-step development process from concept to deployment.', 'icon' => 'fa-list-check', 'color' => '#f97316'],
                            'blog'          => ['name' => 'Blog Posts & Articles', 'desc' => 'Latest published articles, technical tutorials, and insights.', 'icon' => 'fa-newspaper', 'color' => '#6366f1'],
                            'contact'       => ['name' => 'Contact Form Section', 'desc' => 'Public lead capture form, direct WhatsApp, and email links.', 'icon' => 'fa-envelope-circle-check', 'color' => '#10b981'],
                        ];
                    @endphp

                    <div class="row g-3">
                        @foreach($modulesList as $key => $mod)
                            <div class="col-md-6 col-xl-4">
                                <div class="p-3 bg-white rounded-3 border shadow-sm h-100 d-flex flex-column justify-content-between" style="transition:all 0.2s;" onmouseover="this.style.borderColor='#6366f1'" onmouseout="this.style.borderColor='#e2e8f0'">
                                    <div class="d-flex align-items-start gap-3 mb-3">
                                        <div class="p-2.5 rounded-3 text-white text-center flex-shrink-0" style="background:{{ $mod['color'] }}; width:42px; height:42px; display:flex; align-items:center; justify-content:center; font-size:16px;">
                                            <i class="fa-solid {{ $mod['icon'] }}"></i>
                                        </div>
                                        <div>
                                            <h6 class="font-bold mb-1 text-dark" style="font-size:14.5px;">{{ $mod['name'] }}</h6>
                                            <p class="text-muted mb-0" style="font-size:12px; line-height:1.4;">{{ $mod['desc'] }}</p>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                        <span class="badge {{ !empty($settings["{$key}_enabled"]) ? 'bg-success' : 'bg-secondary' }}" id="badge_{{ $key }}">
                                            {{ !empty($settings["{$key}_enabled"]) ? 'Enabled' : 'Disabled' }}
                                        </span>
                                        <div class="form-check form-switch mb-0">
                                            <input type="hidden" name="{{ $key }}_enabled" value="0">
                                            <input class="form-check-input" type="checkbox" name="{{ $key }}_enabled" value="1" id="switch_{{ $key }}"
                                                {{ old("{$key}_enabled", $settings["{$key}_enabled"] ?? true) ? 'checked' : '' }}
                                                style="cursor:pointer; width:38px; height:20px;"
                                                onchange="updateModuleBadge('{{ $key }}', this.checked)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>

        {{-- =========================================================================
             TAB 6: MAINTENANCE & SYSTEM DIAGNOSTICS
        ========================================================================= --}}
        <div class="tab-pane fade" id="tab-system" role="tabpanel">
            <div class="row g-4">
                
                {{-- Maintenance Mode Controls --}}
                <div class="col-lg-6">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-triangle-exclamation text-warning"></i> Website Maintenance Mode</h3>
                        </div>
                        <div class="form-section-body" style="display:grid; gap:16px;">
                            <div class="switch-wrapper p-3 rounded-3" style="background:#fffbeb; border:1.5px solid #fde68a; display:flex; align-items:flex-start; gap:14px;">
                                <input type="hidden" name="maintenance_mode" value="0">
                                <input type="checkbox" name="maintenance_mode" value="1" id="maintenance_mode"
                                    {{ old('maintenance_mode', $settings['maintenance_mode'] ?? false) ? 'checked' : '' }}
                                    style="accent-color:#f59e0b; width:22px; height:22px; cursor:pointer; margin-top:2px;">
                                <div>
                                    <label for="maintenance_mode" class="switch-label mb-1" style="font-weight:700; color:#92400e; cursor:pointer; font-size:14.5px;">
                                        Activate Maintenance Mode
                                    </label>
                                    <p class="mb-0" style="font-size:12.5px; color:#b45309; line-height:1.4;">
                                        When active, regular visitors see a branded maintenance page. Logged-in Admins will always bypass and browse normally.
                                    </p>
                                </div>
                            </div>

                            <div>
                                <label for="maintenance_title" class="form-label-custom">Maintenance Banner Title</label>
                                <input type="text" name="maintenance_title" id="maintenance_title" value="{{ old('maintenance_title', $settings['maintenance_title'] ?? 'We’ll be right back!') }}" class="form-control-custom" placeholder="e.g. Scheduled Upgrades Underway">
                            </div>

                            <div>
                                <label for="maintenance_message" class="form-label-custom">Maintenance Notice Message</label>
                                <textarea name="maintenance_message" id="maintenance_message" rows="3" class="form-control-custom" placeholder="Explain the maintenance reasons or estimated time to visitors…">{{ old('maintenance_message', $settings['maintenance_message'] ?? 'Our website is currently undergoing scheduled maintenance. Please check back shortly.') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Server & Environment Diagnostics --}}
                <div class="col-lg-6">
                    <div class="form-section mb-4">
                        <div class="form-section-header">
                            <h3><i class="fa-solid fa-server text-primary"></i> Server &amp; Environment Diagnostics</h3>
                        </div>
                        <div class="form-section-body p-0">
                            <table class="table table-hover mb-0" style="font-size:13px;">
                                <tbody>
                                    <tr>
                                        <td class="font-bold text-muted ps-3 py-2.5">PHP Version</td>
                                        <td class="pe-3 py-2.5 font-monospace text-dark font-bold">{{ $diagnostics['php_version'] ?? PHP_VERSION }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold text-muted ps-3 py-2.5">Laravel Framework</td>
                                        <td class="pe-3 py-2.5 font-monospace text-primary font-bold">v{{ $diagnostics['laravel_version'] ?? app()->version() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold text-muted ps-3 py-2.5">Database Connection</td>
                                        <td class="pe-3 py-2.5">
                                            @if(!empty($diagnostics['database_connected']))
                                                <span class="badge bg-success"><i class="fa-solid fa-circle-check"></i> Connected ({{ $diagnostics['database_name'] }})</span>
                                            @else
                                                <span class="badge bg-danger"><i class="fa-solid fa-triangle-exclamation"></i> Disconnected</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold text-muted ps-3 py-2.5">Cache Driver</td>
                                        <td class="pe-3 py-2.5 font-monospace">{{ $diagnostics['cache_driver'] ?? config('cache.default') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold text-muted ps-3 py-2.5">Memory Limit</td>
                                        <td class="pe-3 py-2.5 font-monospace">{{ $diagnostics['memory_limit'] ?? ini_get('memory_limit') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold text-muted ps-3 py-2.5">Max Upload Size</td>
                                        <td class="pe-3 py-2.5 font-monospace">{{ $diagnostics['upload_max_size'] ?? ini_get('upload_max_filesize') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-bold text-muted ps-3 py-2.5">Max Execution Time</td>
                                        <td class="pe-3 py-2.5 font-monospace">{{ $diagnostics['max_execution_time'] ?? (ini_get('max_execution_time') . 's') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- Bottom Sticky Save Button Bar --}}
    <div class="d-flex justify-content-between align-items-center p-3 bg-white border rounded-3 shadow-sm mt-4">
        <span class="text-muted" style="font-size:13px;">
            <i class="fa-solid fa-circle-info text-primary me-1"></i>
            Clicking Save will update all parameters across all tabs instantly and clear the settings cache.
        </span>
        <button type="submit" class="btn btn-primary px-4 py-2 font-bold" style="background:#6366f1; border-color:#6366f1; border-radius:8px; display:flex; align-items:center; gap:8px;">
            <i class="fa-solid fa-floppy-disk"></i> Save System Settings
        </button>
    </div>

</form>

@endsection

@push('styles')
<style>
    /* Custom Pill Navigation */
    .custom-system-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        background: #ffffff;
        padding: 8px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }
    .custom-system-pills .nav-link {
        color: #475569;
        font-weight: 600;
        font-size: 13.5px;
        padding: 9px 18px;
        border-radius: 8px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 8px;
        border: 1px solid transparent;
        cursor: pointer;
        background: transparent;
    }
    .custom-system-pills .nav-link:hover {
        background: #f1f5f9;
        color: #1e293b;
    }
    .custom-system-pills .nav-link.active {
        background: #6366f1 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    /* Tab Panes */
    .tab-content > .tab-pane {
        display: none;
    }
    .tab-content > .tab-pane.active.show {
        display: block;
    }

    /* Form Card Styles */
    .form-section {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    .form-section-header {
        padding: 16px 20px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .form-section-header h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-section-body {
        padding: 20px;
    }
    .form-label-custom {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }
    .form-control-custom {
        width: 100%;
        padding: 9px 14px;
        font-size: 13.5px;
        color: #1e293b;
        background-color: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .form-control-custom:focus {
        border-color: #6366f1;
        outline: 0;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }
</style>
@endpush

@push('scripts')
<script>
    // Bulletproof Tab Controller
    function setActiveTab(tabKey) {
        if (!tabKey) tabKey = 'general';

        // 1. Update hidden input
        var input = document.getElementById('active_tab_input');
        if (input) input.value = tabKey;

        // 2. Update URL hash
        if (window.location.hash !== '#' + tabKey) {
            if (history.pushState) {
                history.pushState(null, null, '#' + tabKey);
            } else {
                location.hash = '#' + tabKey;
            }
        }

        // 3. Update tab buttons
        var buttons = document.querySelectorAll('#systemSettingsTabs .nav-link');
        buttons.forEach(function (btn) {
            btn.classList.remove('active');
            btn.setAttribute('aria-selected', 'false');
        });
        var activeBtn = document.getElementById('tab-' + tabKey + '-btn');
        if (activeBtn) {
            activeBtn.classList.add('active');
            activeBtn.setAttribute('aria-selected', 'true');
        }

        // 4. Update tab panes
        var panes = document.querySelectorAll('#systemSettingsTabsContent > .tab-pane');
        panes.forEach(function (pane) {
            pane.classList.remove('show', 'active');
            pane.style.display = 'none';
        });
        var activePane = document.getElementById('tab-' + tabKey);
        if (activePane) {
            activePane.classList.add('show', 'active');
            activePane.style.display = 'block';
        }
    }

    // Initialize tabs on page load & hashchange
    document.addEventListener('DOMContentLoaded', function () {
        var hash = window.location.hash.replace('#', '');
        var validTabs = ['general', 'branding', 'seo', 'smtp', 'modules', 'system'];
        if (hash && validTabs.indexOf(hash) !== -1) {
            setActiveTab(hash);
        } else {
            setActiveTab('general');
        }
        updateSerpPreview();
        updateGradientPreview();
    });

    window.addEventListener('hashchange', function () {
        var hash = window.location.hash.replace('#', '');
        if (hash) {
            setActiveTab(hash);
        }
    });

    // Image preview helper
    function previewImage(input, previewImgId, placeholderId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var img = document.getElementById(previewImgId);
                var placeholder = document.getElementById(placeholderId);
                if (img) {
                    img.src = e.target.result;
                    img.style.display = 'inline-block';
                }
                if (placeholder) {
                    placeholder.style.display = 'none';
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Password visibility toggle
    function togglePasswordVisibility(inputId, btn) {
        var input = document.getElementById(inputId);
        var icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Color synchronization
    function syncColorInput(type, val) {
        var hexInput = document.getElementById(type + '_hex');
        if (hexInput) hexInput.value = val;
        updateGradientPreview();
    }

    function syncColorHex(type, val) {
        if (val && !val.startsWith('#')) val = '#' + val;
        if (/^#[0-9A-Fa-f]{6}$/.test(val)) {
            var colorInput = document.getElementById(type + '_color');
            if (colorInput) colorInput.value = val;
        }
        updateGradientPreview();
    }

    // Live Gradient updater
    function updateGradientPreview() {
        var c1 = document.getElementById('primary_color') ? document.getElementById('primary_color').value : '#3b82f6';
        var c2 = document.getElementById('secondary_color') ? document.getElementById('secondary_color').value : '#1e40af';
        var box = document.getElementById('gradientPreviewBox');
        if (box) {
            box.style.background = 'linear-gradient(135deg, ' + c1 + ', ' + c2 + ')';
        }
        var siteNameInput = document.getElementById('site_name');
        var textEl = document.getElementById('gradientPreviewText');
        if (siteNameInput && textEl) {
            textEl.textContent = siteNameInput.value || 'AmanProjects';
        }
    }

    if (document.getElementById('site_name')) {
        document.getElementById('site_name').addEventListener('input', updateGradientPreview);
    }

    // SERP Preview & Character Counter
    function updateSerpPreview() {
        var title = document.getElementById('site_title') ? document.getElementById('site_title').value : 'AmanProjects';
        var desc = document.getElementById('meta_description') ? document.getElementById('meta_description').value : '';
        
        var serpTitle = document.getElementById('serpTitlePreview');
        var serpDesc = document.getElementById('serpDescPreview');
        var counter = document.getElementById('metaDescCounter');

        if (serpTitle) serpTitle.textContent = title || 'AmanProjects';
        if (serpDesc) serpDesc.textContent = desc || 'Website meta description preview...';
        
        if (counter) {
            var len = desc.length;
            counter.textContent = len + ' / 160 Recommended';
            if (len > 160) {
                counter.className = 'badge bg-warning text-dark border';
            } else if (len > 0) {
                counter.className = 'badge bg-success border';
            } else {
                counter.className = 'badge bg-light text-secondary border';
            }
        }
    }

    if (document.getElementById('site_title')) {
        document.getElementById('site_title').addEventListener('input', updateSerpPreview);
    }

    // Feature module badge toggle
    function updateModuleBadge(key, isChecked) {
        var badge = document.getElementById('badge_' + key);
        if (badge) {
            badge.textContent = isChecked ? 'Enabled' : 'Disabled';
            badge.className = isChecked ? 'badge bg-success' : 'badge bg-secondary';
        }
    }

    // SMTP Test Runner via AJAX
    function runSmtpTest() {
        var recipient = document.getElementById('test_email_recipient').value;
        var btn = document.getElementById('btnSendTestEmail');
        var resultBox = document.getElementById('smtpTestResultBox');

        if (!recipient) {
            alert('Please enter a recipient email address to test.');
            return;
        }

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Connecting & Sending Test Email...';
        resultBox.style.display = 'none';

        var payload = {
            test_email: recipient,
            mail_mailer: document.getElementById('mail_mailer').value,
            mail_host: document.getElementById('mail_host').value,
            mail_port: document.getElementById('mail_port').value,
            mail_encryption: document.getElementById('mail_encryption').value,
            mail_username: document.getElementById('mail_username').value,
            mail_password: document.getElementById('mail_password').value,
            mail_from_address: document.getElementById('mail_from_address').value,
            mail_from_name: document.getElementById('mail_from_name').value,
            _token: '{{ csrf_token() }}'
        };

        fetch('{{ route('admin.settings.test-email') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        })
        .then(function(res) {
            return res.json().then(function(data) {
                return { status: res.status, ok: res.ok, data: data };
            });
        })
        .then(function(response) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Send Test Email Now';
            resultBox.style.display = 'block';

            if (response.ok && response.data.success) {
                resultBox.className = 'mt-3 p-3 rounded-3 bg-success-subtle text-success border border-success';
                resultBox.innerHTML = '<i class="fa-solid fa-circle-check fa-lg me-2"></i><strong>Success:</strong> ' + response.data.message;
            } else {
                resultBox.className = 'mt-3 p-3 rounded-3 bg-danger-subtle text-danger border border-danger';
                resultBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation fa-lg me-2"></i><strong>SMTP Error:</strong> ' + (response.data.message || 'Failed to send test email.');
            }
        })
        .catch(function(err) {
            btn.disabled = false;
            btn.innerHTML = '<i class="fa-solid fa-paper-plane"></i> Send Test Email Now';
            resultBox.style.display = 'block';
            resultBox.className = 'mt-3 p-3 rounded-3 bg-danger-subtle text-danger border border-danger';
            resultBox.innerHTML = '<i class="fa-solid fa-triangle-exclamation fa-lg me-2"></i><strong>Network / Server Error:</strong> ' + err.message;
        });
    }
</script>
@endpush
