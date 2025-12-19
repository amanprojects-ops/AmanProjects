@extends('layouts.admin')

@section('title', 'Skills')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Skills</h1>
    <a href="{{ route('admin.skills.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700"><i class="fa-solid fa-plus" aria-hidden="true"></i> Add Skill</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Level</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Visible</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($skills as $skill)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $skill->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $skill->category ?: '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-24 bg-gray-200 rounded-full h-2 mr-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $skill->level }}%"></div>
                            </div>
                            <span>{{ $skill->level }}%</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded {{ $skill->show ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $skill->show ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="text-blue-600 hover:underline mr-3"><i class="fa-solid fa-pen-to-square" aria-hidden="true"></i> Edit</a>
                        <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline"><i class="fa-solid fa-trash" aria-hidden="true"></i> Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No skills found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
