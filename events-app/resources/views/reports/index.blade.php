<x-app-layout>
    <x-slot name="header"><h2 class="h5 mb-0">Reports</h2></x-slot>
    <div class="container py-4">
        <div class="row g-3 mb-4">
            <div class="col-md-4"><div class="card shadow-sm border-0"><div class="card-body">
                <p class="text-muted small mb-1">Total Capacity</p>
                <h3 class="mb-0">{{ $totalCapacity }}</h3>
            </div></div></div>
            <div class="col-md-4"><div class="card shadow-sm border-0"><div class="card-body">
                <p class="text-muted small mb-1">Total Registrations</p>
                <h3 class="mb-0">{{ $totalRegistrations }}</h3>
            </div></div></div>
            <div class="col-md-4"><div class="card shadow-sm border-0"><div class="card-body">
                <p class="text-muted small mb-1">Total Checked In</p>
                <h3 class="mb-0">{{ $totalCheckedIn }}</h3>
            </div></div></div>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5 class="mb-3">Per Event</h5>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead><tr>
                            <th>Event</th><th>Capacity</th><th>Registered</th><th>Checked In</th>
                        </tr></thead>
                        <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->capacity }}</td>
                                <td>{{ $event->registrations_count }}</td>
                                <td>{{ $event->checked_in_count }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">No events yet.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>