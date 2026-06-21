<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">Browse Events</h2>
    </x-slot>

    <div class="container py-4">

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if ($events->isEmpty())
            <div class="card shadow-sm">
                <div class="card-body text-center text-muted py-5">
                    No events are open for registration right now. Check back soon.
                </div>
            </div>
        @else
            <div class="row g-3">
                @foreach ($events as $event)
                    @php
                        $slotsLeft = max($event->capacity - $event->registrations_count, 0);
                    @endphp
                    <div class="col-md-6">
                        <a href="{{ route('events.show', $event) }}" class="text-decoration-none">
                            <div class="card shadow-sm h-100" style="border-color:#e9d5ff;">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h5 class="card-title mb-1 text-dark">{{ $event->title }}</h5>
                                        @if ($slotsLeft === 0)
                                            <span class="badge bg-secondary">Full</span>
                                        @else
                                            <span class="badge" style="background-color:#c026d3;">{{ $slotsLeft }} slots left</span>
                                        @endif
                                    </div>
                                    <p class="text-muted small mb-2">
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y g:i A') }}
                                        &middot; {{ $event->location }}
                                    </p>
                                    <p class="card-text text-secondary small">{{ Str::limit($event->description, 110) }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>