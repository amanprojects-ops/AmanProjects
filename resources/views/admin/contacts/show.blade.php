@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Message Details</h1>
    <a href="{{ route('admin.contacts.index') }}" class="text-blue-600 hover:underline">← Back to Messages</a>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <div class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-500">From</label>
            <p class="text-gray-900">{{ $contact->name }} ({{ $contact->email }})</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-500">Subject</label>
            <p class="text-gray-900">{{ $contact->subject }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-500">Date</label>
            <p class="text-gray-900">{{ $contact->created_at->format('F d, Y H:i') }}</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-500">Message</label>
            <div class="mt-2 p-4 bg-gray-50 rounded-lg">
                {!! nl2br(e($contact->message)) !!}
            </div>
        </div>
    </div>

    <div class="mt-6 flex space-x-4">
        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Reply via Email</a>
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">Delete</button>
        </form>
    </div>
</div>
@endsection
