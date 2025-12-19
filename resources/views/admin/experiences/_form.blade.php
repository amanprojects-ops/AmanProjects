<div class="space-y-6 mb-6">
    <div>
        <label for="company" class="block text-sm font-medium text-gray-700 mb-1">Company</label>
        <input type="text" name="company" id="company" value="{{ old('company', $experience->company ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('company')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
        <input type="text" name="role" id="role" value="{{ old('role', $experience->role ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('role')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', isset($experience) && $experience->start_date ? $experience->start_date->format('Y-m-d') : '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('start_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date (leave empty for current)</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', isset($experience) && $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('end_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $experience->description ?? '') }}</textarea>
        @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
        <input type="number" name="order" id="order" value="{{ old('order', $experience->order ?? 0) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('order')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
</div>
