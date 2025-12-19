@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')
<h1 class="text-2xl font-bold mb-6">Add Category</h1>

<form action="{{ route('admin.categories.store') }}" method="POST" class="bg-white rounded-lg shadow p-6 max-w-xl">
    @csrf
    @include('admin.categories._form')
    <div class="flex space-x-4">
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Create</button>
        <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Cancel</a>
    </div>
</form>
@endsection
