<div class="space-y-6 mb-6">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $socialLink->name ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="e.g., GitHub, LinkedIn">
        @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="url" class="block text-sm font-medium text-gray-700 mb-1">URL</label>
        <input type="url" name="url" id="url" value="{{ old('url', $socialLink->url ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://...">
        @error('url')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="icon" class="block text-sm font-medium text-gray-700 mb-1">Icon Class (optional)</label>
        <input type="text" name="icon" id="icon" value="{{ old('icon', $socialLink->icon ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="e.g., fab fa-github">
        @error('icon')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $socialLink->is_active ?? true) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded">
        <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
    </div>
</div>
