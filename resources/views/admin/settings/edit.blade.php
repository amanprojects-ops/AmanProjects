@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
<h1 class="text-2xl font-bold mb-6">Site Settings</h1>

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')

    <!-- General Settings -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">General Settings</h2>
        <div class="space-y-4">
            <div>
                <label for="site_title" class="block text-sm font-medium text-gray-700 mb-1">Site Title</label>
                <input type="text" name="site_title" id="site_title" value="{{ old('site_title', $settings['site_title']) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                <textarea name="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('meta_description', $settings['meta_description']) }}</textarea>
            </div>
            <div>
                <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords']) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
    </div>

    <!-- Branding -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Branding</h2>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label for="favicon" class="block text-sm font-medium text-gray-700 mb-1">Favicon</label>
                @if($settings['favicon'])
                    <img src="@fileUrl($settings['favicon'])" alt="Favicon" class="w-8 h-8 mb-2">
                @endif
                <input type="file" name="favicon" id="favicon" accept=".ico,.png" class="w-full">
            </div>
            <div>
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                @if($settings['logo'])
                    <img src="@fileUrl($settings['logo'])" alt="Logo" class="h-10 mb-2">
                @endif
                <input type="file" name="logo" id="logo" accept="image/*" class="w-full">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-6 mt-4">
            <div>
                <label for="primary_color" class="block text-sm font-medium text-gray-700 mb-1">Primary Color</label>
                <input type="color" name="primary_color" id="primary_color" value="{{ old('primary_color', $settings['primary_color']) }}" class="w-full h-10 border border-gray-300 rounded-lg">
            </div>
            <div>
                <label for="secondary_color" class="block text-sm font-medium text-gray-700 mb-1">Secondary Color</label>
                <input type="color" name="secondary_color" id="secondary_color" value="{{ old('secondary_color', $settings['secondary_color']) }}" class="w-full h-10 border border-gray-300 rounded-lg">
            </div>
        </div>
    </div>

    <!-- Section Toggles -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Section Visibility</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach(['about', 'skills', 'projects', 'experience', 'education', 'blog', 'contact'] as $section)
                <label class="flex items-center">
                    <input type="hidden" name="{{ $section }}_enabled" value="0">
                    <input type="checkbox" name="{{ $section }}_enabled" value="1" {{ old("{$section}_enabled", $settings["{$section}_enabled"]) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">{{ ucfirst($section) }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <!-- Maintenance Mode -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Maintenance</h2>
        <label class="flex items-center">
            <input type="hidden" name="maintenance_mode" value="0">
            <input type="checkbox" name="maintenance_mode" value="1" {{ old('maintenance_mode', $settings['maintenance_mode']) ? 'checked' : '' }} class="h-4 w-4 text-red-600 border-gray-300 rounded">
            <span class="ml-2 text-sm text-gray-700">Enable Maintenance Mode</span>
        </label>
        <p class="text-sm text-gray-500 mt-1">When enabled, visitors will see a maintenance page. Logged-in admins can still access the site.</p>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Save Settings</button>
</form>
@endsection
