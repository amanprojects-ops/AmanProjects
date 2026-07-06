@extends('layouts.admin')

@section('title', 'Site Settings')
@section('page_title', '<span>Site</span> Settings')

@section('content')

<div class="page-header" style="display:flex; justify-content:space-between; align-items:center;">
    <h1 class="page-title" style="margin:0;">
        <span class="title-icon"><i class="fa-solid fa-gear"></i></span>
        Site Settings
    </h1>
    <form action="{{ route('admin.settings.flush-cache') }}" method="POST" style="margin:0;">
        @csrf
        <button type="submit" class="btn-admin-danger" style="background-color:#ef4444; color:white; padding:8px 16px; border-radius:6px; border:none; cursor:pointer;" onclick="return confirm('Are you sure you want to flush the entire application cache?')">
            <i class="fa-solid fa-broom"></i> Flush Cache
        </button>
    </form>
</div>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">

            {{-- General --}}
            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-globe" style="color:#6366f1;"></i> General Settings</h3>
                </div>
                <div class="form-section-body" style="display:grid;gap:16px;">
                    <div>
                        <label for="site_name" class="form-label-custom">Site Name</label>
                        <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name']) }}"
                            class="form-control-custom" placeholder="Site Name">
                    </div>
                    <div>
                        <label for="site_title" class="form-label-custom">Site Title</label>
                        <input type="text" name="site_title" id="site_title" value="{{ old('site_title', $settings['site_title']) }}"
                            class="form-control-custom" placeholder="Site Title">
                    </div>
                    <div>
                        <label for="meta_description" class="form-label-custom">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3"
                            class="form-control-custom" style="resize:vertical;" placeholder="Short website description for search engines…">{{ old('meta_description', $settings['meta_description']) }}</textarea>
                    </div>
                    <div>
                        <label for="meta_keywords" class="form-label-custom">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords']) }}"
                            class="form-control-custom" placeholder="developer, portfolio, laravel, vue…">
                    </div>
                </div>
            </div>

            {{-- Section Visibility --}}
            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-eye" style="color:#6366f1;"></i> Section Visibility</h3>
                </div>
                <div class="form-section-body">
                    <p style="font-size:13px;color:#64748b;margin-bottom:16px;">Toggle which sections are visible on your public portfolio.</p>
                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px;">
                        @foreach(['about', 'skills', 'projects', 'how_we_work', 'blog', 'contact'] as $section)
                            <div class="switch-wrapper">
                                <input type="hidden" name="{{ $section }}_enabled" value="0">
                                <input type="checkbox" name="{{ $section }}_enabled" value="1"
                                    {{ old("{$section}_enabled", $settings["{$section}_enabled"]) ? 'checked' : '' }}
                                    style="accent-color:#6366f1;width:16px;height:16px;cursor:pointer;"
                                    id="section_{{ $section }}">
                                <label for="section_{{ $section }}" class="switch-label" style="cursor:pointer;text-transform:capitalize;">{{ $section }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Local SEO --}}
            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-map-location-dot" style="color:#6366f1;"></i> Local SEO Settings</h3>
                </div>
                <div class="form-section-body" style="display:grid;gap:16px;">
                    <div>
                        <label for="local_business_address" class="form-label-custom">Business Address</label>
                        <textarea name="local_business_address" id="local_business_address" rows="2"
                            class="form-control-custom" style="resize:vertical;" placeholder="Full Address for Local SEO">{{ old('local_business_address', $settings['local_business_address']) }}</textarea>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div>
                            <label for="local_business_phone" class="form-label-custom">Business Phone</label>
                            <input type="text" name="local_business_phone" id="local_business_phone" value="{{ old('local_business_phone', $settings['local_business_phone']) }}"
                                class="form-control-custom" placeholder="+91...">
                        </div>
                        <div>
                            <label for="local_business_email" class="form-label-custom">Business Email</label>
                            <input type="email" name="local_business_email" id="local_business_email" value="{{ old('local_business_email', $settings['local_business_email']) }}"
                                class="form-control-custom" placeholder="contact@domain.com">
                        </div>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div>
                            <label for="local_business_lat" class="form-label-custom">Latitude</label>
                            <input type="text" name="local_business_lat" id="local_business_lat" value="{{ old('local_business_lat', $settings['local_business_lat']) }}"
                                class="form-control-custom" placeholder="e.g. 28.704060">
                        </div>
                        <div>
                            <label for="local_business_lng" class="form-label-custom">Longitude</label>
                            <input type="text" name="local_business_lng" id="local_business_lng" value="{{ old('local_business_lng', $settings['local_business_lng']) }}"
                                class="form-control-custom" placeholder="e.g. 77.102493">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Maintenance --}}
            <div class="form-section">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-triangle-exclamation" style="color:#f59e0b;"></i> Maintenance Mode</h3>
                </div>
                <div class="form-section-body">
                    <div class="switch-wrapper" style="border-color:#fde68a;background:#fffbeb;">
                        <input type="hidden" name="maintenance_mode" value="0">
                        <input type="checkbox" name="maintenance_mode" value="1"
                            {{ old('maintenance_mode', $settings['maintenance_mode']) ? 'checked' : '' }}
                            style="accent-color:#f59e0b;width:18px;height:18px;cursor:pointer;" id="maintenance_mode">
                        <div>
                            <label for="maintenance_mode" class="switch-label" style="cursor:pointer;color:#92400e;">Enable Maintenance Mode</label>
                            <p style="font-size:12px;color:#b45309;margin:0;">Visitors see a maintenance page. Admins can still access the site.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            {{-- Branding --}}
            <div class="form-section mb-4">
                <div class="form-section-header">
                    <h3><i class="fa-solid fa-palette" style="color:#6366f1;"></i> Branding</h3>
                </div>
                <div class="form-section-body" style="display:grid;gap:16px;">

                    <div>
                        <label class="form-label-custom">Favicon</label>
                        @if($settings['favicon'])
                            <div style="margin-bottom:8px;">
                                <img src="@fileUrl($settings['favicon'])" alt="Favicon" style="width:32px;height:32px;border-radius:6px;border:2px solid #e2e8f0;">
                            </div>
                        @endif
                        <div class="file-input-wrapper">
                            <input type="file" name="favicon" id="favicon" accept=".ico,.png">
                            <div class="file-input-label">
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size:15px;"></i>
                                <span style="font-size:13px;">Upload Favicon (.ico, .png)</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="form-label-custom">Logo</label>
                        @if($settings['logo'])
                            <div style="margin-bottom:8px;padding:8px;background:#f8fafc;border-radius:8px;border:1px solid #e2e8f0;">
                                <img src="@fileUrl($settings['logo'])" alt="Logo" style="height:36px;max-width:100%;object-fit:contain;">
                            </div>
                        @endif
                        <div class="file-input-wrapper">
                            <input type="file" name="logo" id="logo" accept="image/*">
                            <div class="file-input-label">
                                <i class="fa-solid fa-cloud-arrow-up" style="font-size:15px;"></i>
                                <span style="font-size:13px;">Upload Logo (PNG, SVG)</span>
                            </div>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div>
                            <label for="primary_color" class="form-label-custom">Primary Color</label>
                            <div style="position:relative;">
                                <input type="color" name="primary_color" id="primary_color"
                                    value="{{ old('primary_color', $settings['primary_color']) }}"
                                    style="width:100%;height:44px;border:1.5px solid #e2e8f0;border-radius:10px;cursor:pointer;padding:4px;">
                            </div>
                        </div>
                        <div>
                            <label for="secondary_color" class="form-label-custom">Secondary Color</label>
                            <input type="color" name="secondary_color" id="secondary_color"
                                value="{{ old('secondary_color', $settings['secondary_color']) }}"
                                style="width:100%;height:44px;border:1.5px solid #e2e8f0;border-radius:10px;cursor:pointer;padding:4px;">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div style="display:flex;gap:12px;margin-top:8px;">
        <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-floppy-disk"></i> Save Settings
        </button>
    </div>

</form>

@endsection
