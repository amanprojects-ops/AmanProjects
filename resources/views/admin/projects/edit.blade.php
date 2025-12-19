@extends('layouts.admin')

@section('title', 'Edit Project')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Project</h1>

<form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6 max-w-2xl">
    @csrf
    @method('PUT')
    @include('admin.projects._form')
    <div class="flex space-x-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.projects.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Cancel</a>
    </div>
</form>
@endsection
