<div class="space-y-6 mb-6">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
        <input type="text" name="name" id="name" value="{{ old('name', $skill->name ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
        <input type="text" name="category" id="category" value="{{ old('category', $skill->category ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="e.g., Frontend, Backend">
        @error('category')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Level (%)</label>
        <input type="number" name="level" id="level" value="{{ old('level', $skill->level ?? 50) }}" min="0" max="100" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('level')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="flex items-center">
        <input type="hidden" name="show" value="0">
        <input type="checkbox" name="show" id="show" value="1" {{ old('show', $skill->show ?? true) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded">
        <label for="show" class="ml-2 text-sm text-gray-700">Show on website</label>
    </div>
</div>
