<x-app-layout>
    <x-slot name="header"><h2 class="h5 mb-0">Dashboard</h2></x-slot>

    <div class="container-fluid">
        {{-- Stat cards --}}
        <div class="row g-3 mb-4">
            @if ($isAdmin)
                <div class="col-6 col-lg-3"><div class="mc-stat">
                    <p class="text-muted small mb-1">Total Events</p>
                    <div class="mc-stat-num" style="color:var(--mc-primary);">{{ $stats['events'] }}</div>
                </div></div>
                <div class="col-6 col-lg-3"><div class="mc-stat">
                    <p class="text-muted small mb-1">Registrations</p>
                    <div class="mc-stat-num">{{ $stats['registrations'] }}</div>
                </div></div>
                <div class="col-6 col-lg-3"><div class="mc-stat">
                    <p class="text-muted small mb-1">Checked In</p>
                    <div class="mc-stat-num text-success">{{ $stats['checkedIn'] }}</div>
                </div></div>
                <div class="col-6 col-lg-3"><div class="mc-stat">
                    <p class="text-muted small mb-1">Total Capacity</p>
                    <div class="mc-stat-num">{{ $stats['capacity'] }}</div>
                </div></div>
            @else
                <div class="col-6"><div class="mc-stat">
                    <p class="text-muted small mb-1">My Tickets</p>
                    <div class="mc-stat-num" style="color:var(--mc-primary);">{{ $stats['myTickets'] }}</div>
                </div></div>
                <div class="col-6"><div class="mc-stat">
                    <p class="text-muted small mb-1">Events Attended</p>
                    <div class="mc-stat-num text-success">{{ $stats['checkedIn'] }}</div>
                </div></div>
            @endif
        </div>

        {{-- Upcoming events --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Upcoming Events</h5>
            <a href="{{ route('events.index') }}" class="text-decoration-none">See all &rarr;</a>
        </div>

        @if ($upcoming->isEmpty())
            <div class="card shadow-sm"><div class="card-body text-center text-muted py-5">
                No upcoming events.
                @if ($isAdmin)
                    <a href="{{ route('admin.events.create') }}">Create one &rarr;</a>
                @endif
            </div></div>
        @else
            <div class="row g-3">
                @foreach ($upcoming as $event)
                    @php($slotsLeft = max($event->capacity - $event->registrations_count, 0))
                    @php($pct = $event->capacity > 0 ? round($event->registrations_count / $event->capacity * 100) : 0)
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('events.show', $event) }}" class="text-decoration-none">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h6 class="text-dark mb-1">{{ $event->title }}</h6>
                                    <p class="text-muted small mb-3">{{ $event->start_date->format('M d, Y') }}</p>
                                    <div class="d-flex justify-content-between small mb-1">
                                        <span class="text-muted">Filled</span>
                                        <span class="fw-medium">{{ $pct }}%</span>
                                    </div>
                                    <div class="progress" style="height:6px;">
                                        <div class="progress-bar" style="width: {{ $pct }}%; background: var(--mc-primary);"></div>
                                    </div>
                                    <p class="small text-muted mt-2 mb-0">{{ $slotsLeft }} slots left</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>