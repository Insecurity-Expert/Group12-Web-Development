<x-app-layout>
    <x-slot name="header"><h2 class="h5 mb-0">Manage Events</h2></x-slot>
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">All Events</h4>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">+ New Event</a>
        </div>
        <div class="card shadow-sm border-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Title</th><th>Date</th><th>Location</th>
                            <th>Capacity</th><th>Registered</th><th>Status</th><th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->start_date->format('M d, Y g:i A') }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->capacity }}</td>
                            <td>{{ $event->registrations_count }}</td>
                            <td>
                                @if ($event->is_published)
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="d-inline"
                                      onsubmit="return confirm('Delete this event?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No events yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>