@extends('layouts.admin')

@section('title', 'Edit Skill')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Skill</h1>

<form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="bg-white rounded-lg shadow p-6 max-w-xl">
    @csrf
    @method('PUT')
    @include('admin.skills._form')
    <div class="flex space-x-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Update</button>
        <a href="{{ route('admin.skills.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Cancel</a>
    </div>
</form>
@endsection
