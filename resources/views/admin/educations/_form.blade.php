<div class="space-y-6 mb-6">
    <div>
        <label for="institute" class="block text-sm font-medium text-gray-700 mb-1">Institute</label>
        <input type="text" name="institute" id="institute" value="{{ old('institute', $education->institute ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('institute')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="degree" class="block text-sm font-medium text-gray-700 mb-1">Degree</label>
        <input type="text" name="degree" id="degree" value="{{ old('degree', $education->degree ?? '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('degree')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date', isset($education) && $education->start_date ? $education->start_date->format('Y-m-d') : '') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('start_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', isset($education) && $education->end_date ? $education->end_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
            @error('end_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('description', $education->description ?? '') }}</textarea>
        @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 mb-1">Order</label>
        <input type="number" name="order" id="order" value="{{ old('order', $education->order ?? 0) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        @error('order')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>
</div>
