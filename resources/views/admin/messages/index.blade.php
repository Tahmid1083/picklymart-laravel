@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="admin-toolbar">
    <h2 style="font-size:17px;font-weight:800">Contact Messages ({{ $messages->total() }})</h2>
</div>

<table class="admin-table">
    <thead><tr><th>Name</th><th>Email</th><th>Subject</th><th>Message</th><th>Status</th><th>Date</th><th style="width:190px">Actions</th></tr></thead>
    <tbody>
        @forelse ($messages as $message)
            <tr>
                <td><b>{{ $message->name }}</b></td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->subject ?: '—' }}</td>
                <td>{{ \Illuminate\Support\Str::limit($message->message, 60) }}</td>
                <td><span class="status {{ $message->is_read ? 'delivered' : 'pending' }}">{{ $message->is_read ? 'read' : 'unread' }}</span></td>
                <td>{{ $message->created_at->format('d M, Y') }}</td>
                <td>
                    @unless ($message->is_read)
                        <form action="{{ route('admin.messages.read', $message) }}" method="POST" style="display:inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-outline btn-sm" type="submit">Mark read</button>
                        </form>
                    @endunless
                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this message?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="7" style="text-align:center;color:#6b7280;padding:30px">No messages yet.</td></tr>
        @endforelse
    </tbody>
</table>

<div class="pagination">{{ $messages->links() }}</div>
@endsection
