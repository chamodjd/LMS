@extends('dashboard_app')

@push('title')
    Contact Messages
@endpush
@section('content')

    <div style="margin-left:220px; padding:24px; flex:1; background:#f9fafb;">

        <h1 style="font-size:22px; font-weight:600; color:#111827; margin-bottom:16px;">Contact Messages</h1>

        <div style="background:white; border:1px solid #e5e7eb; border-radius:12px; padding:20px;">
            <table class="table table-hover" id="contactTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Received</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->contact_no }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center;padding:16px;color:#8A8AA3;">No messages yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection
