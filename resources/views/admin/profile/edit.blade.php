@extends('layouts.admin')

@section('title', 'Edit Profile')

@section('content')
<h1 class="text-2xl font-bold mb-6"><i class="fa-solid fa-user" aria-hidden="true"></i> Edit Profile</h1>

<form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-2xl">
    @csrf
    @method('PUT')

    <div class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $profile->title ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="e.g., Full Stack Developer">
            @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
            <textarea name="bio" id="bio" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('bio', $profile->bio ?? '') }}</textarea>
            @error('bio')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="+1 234 567 890">
            @error('phone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $profile->location ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="City, Country">
            @error('location')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="website" class="block text-sm font-medium text-gray-700 mb-1">Website</label>
            <input type="url" name="website" id="website" value="{{ old('website', $profile->website ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://yourwebsite.com">
            @error('website')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="profile_image" class="block text-sm font-medium text-gray-700 mb-1">Profile Image</label>
            @if($profile->profile_image ?? false)
                <img src="@fileUrl($profile->profile_image)" alt="Profile" class="w-24 h-24 rounded-full object-cover mb-2">
            @endif
            <input type="file" name="profile_image" id="profile_image" accept="image/*" class="w-full">
            @error('profile_image')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="resume" class="block text-sm font-medium text-gray-700 mb-1">Resume (PDF)</label>
            @if($profile->resume ?? false)
                <p class="text-sm text-gray-500 mb-2">Current: <a href="@fileUrl($profile->resume)" target="_blank" class="text-blue-600 hover:underline">View Resume</a></p>
            @endif
            <input type="file" name="resume" id="resume" accept=".pdf" class="w-full">
            @error('resume')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700"><i class="fa-solid fa-floppy-disk" aria-hidden="true"></i> Save Changes</button>
    </div>
</form>
@endsection
