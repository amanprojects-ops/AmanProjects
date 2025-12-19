<div class="space-y-6 mb-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title', $project->title ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $project->description ?? '') }}</textarea>
        @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="tech_stack_tags" class="block text-sm font-medium text-gray-700 mb-1">Tech Stack (comma separated)</label>
        <input type="text" name="tech_stack_tags" id="tech_stack_tags" value="{{ old('tech_stack_tags', $project->tech_stack_tags ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Laravel, Vue.js, MySQL">
        @error('tech_stack_tags')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="github_link" class="block text-sm font-medium text-gray-700 mb-1">GitHub Link</label>
            <input type="url" name="github_link" id="github_link" value="{{ old('github_link', $project->github_link ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('github_link')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="live_demo_link" class="block text-sm font-medium text-gray-700 mb-1">Live Demo Link</label>
            <input type="url" name="live_demo_link" id="live_demo_link" value="{{ old('live_demo_link', $project->live_demo_link ?? '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('live_demo_link')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label for="thumbnail_image" class="block text-sm font-medium text-gray-700 mb-1">Thumbnail Image</label>
        @if(isset($project) && $project->thumbnail_image)
            <img src="@fileUrl($project->thumbnail_image)" alt="" class="w-32 h-24 object-cover rounded mb-2">
        @endif
        <input type="file" name="thumbnail_image" id="thumbnail_image" accept="image/*" class="w-full">
        @error('thumbnail_image')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            <option value="draft" {{ old('status', $project->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ old('status', $project->status ?? '') === 'published' ? 'selected' : '' }}>Published</option>
        </select>
    </div>

    <div class="flex items-center">
        <input type="hidden" name="featured" value="0">
        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured', $project->featured ?? false) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 rounded">
        <label for="featured" class="ml-2 text-sm text-gray-700">Featured project</label>
    </div>
</div>
