@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-6"><i class="fa-solid fa-gauge" aria-hidden="true"></i> Dashboard</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500 text-sm font-medium"><i class="fa-solid fa-diagram-project" aria-hidden="true"></i> Total Projects</h3>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['projects'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500 text-sm font-medium"><i class="fa-solid fa-newspaper" aria-hidden="true"></i> Blog Posts</h3>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['posts'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500 text-sm font-medium"><i class="fa-solid fa-envelope" aria-hidden="true"></i> Unread Messages</h3>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['contacts'] }}</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h2 class="text-lg font-semibold">Recent Messages</h2>
    </div>
    <div class="p-6">
        @forelse($recentContacts as $contact)
            <div class="flex items-center justify-between py-3 border-b last:border-0">
                <div>
                    <p class="font-medium {{ !$contact->read ? 'text-blue-600' : 'text-gray-900' }}">{{ $contact->name }}</p>
                    <p class="text-sm text-gray-500">{{ $contact->subject }}</p>
                </div>
                <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600 hover:underline text-sm"><i class="fa-solid fa-eye" aria-hidden="true"></i> View</a>
            </div>
        @empty
            <p class="text-gray-500">😕 No messages yet.</p>
        @endforelse
    </div>
</div>
@endsection
