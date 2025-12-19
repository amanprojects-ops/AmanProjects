@extends('layouts.admin')

@section('title', 'Education')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Education</h1>
    <a href="{{ route('admin.educations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Add Education</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Institute</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Degree</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Period</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($educations as $education)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $education->institute }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $education->degree }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $education->start_date->format('M Y') }} - {{ $education->end_date ? $education->end_date->format('M Y') : 'Present' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <a href="{{ route('admin.educations.edit', $education) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                        <form action="{{ route('admin.educations.destroy', $education) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No education found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
