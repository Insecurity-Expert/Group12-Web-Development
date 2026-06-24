<x-app-layout>
    <x-slot name="header"><h2 class="h5 mb-0">Welcome</h2></x-slot>

    <div class="bg-primary text-white py-5 mb-4" style="background: linear-gradient(120deg,#5b4bdb,#8b5cf6) !important;">
        <div class="container text-center py-4">
            <h1 class="fw-bold mb-3">Find and join events near you</h1>
            <p class="lead mb-4">Browse upcoming events, grab your ticket, and check in at the door.</p>
            <a href="{{ route('events.index') }}" class="btn btn-light btn-lg px-4">Browse Events</a>
        </div>
    </div>

    <div class="container py-2">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Upcoming Events</h4>
            <a href="{{ route('events.index') }}" class="text-decoration-none">See all &rarr;</a>
        </div>

        @if ($events->isEmpty())
            <div class="card shadow-sm"><div class="card-body text-center text-muted py-5">
                No upcoming events right now. Check back soon.
            </div></div>
        @else
            <div class="row g-3">
                @foreach ($events as $event)
                    @php($slotsLeft = max($event->capacity - $event->registrations_count, 0))
                    <div class="col-md-4">
                        <a href="{{ route('events.show', $event) }}" class="text-decoration-none">
                            <div class="card shadow-sm h-100 border-0">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h5 class="card-title mb-0 text-dark">{{ $event->title }}</h5>
                                        @if ($slotsLeft === 0)
                                            <span class="badge bg-secondary">Full</span>
                                        @else
                                            <span class="badge" style="background:#c026d3;">{{ $slotsLeft }} left</span>
                                        @endif
                                    </div>
                                    <p class="text-muted small mb-2">
                                        {{ $event->start_date->format('M d, Y g:i A') }} &middot; {{ $event->location }}
                                    </p>
                                    <p class="text-secondary small mb-0">{{ \Illuminate\Support\Str::limit($event->description, 90) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
