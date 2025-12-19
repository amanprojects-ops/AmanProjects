@extends('layouts.admin')

@section('title', 'Contacts')

@section('content')
<h1 class="text-2xl font-bold mb-6">Contact Messages</h1>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($contacts as $contact)
                <tr class="{{ !$contact->read ? 'bg-blue-50' : '' }}">
                    <td class="px-6 py-4 whitespace-nowrap font-medium {{ !$contact->read ? 'text-blue-600' : '' }}">{{ $contact->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $contact->email }}</td>
                    <td class="px-6 py-4">{{ Str::limit($contact->subject, 40) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $contact->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600 hover:underline mr-3">View</a>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No messages found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $contacts->links() }}
</div>
@endsection
