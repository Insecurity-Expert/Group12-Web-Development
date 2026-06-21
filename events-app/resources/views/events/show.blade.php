<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">{{ $event->title }}</h2>
    </x-slot>

    <div class="container py-4" style="max-width: 720px;">

        <a href="{{ route('events.index') }}" class="small text-decoration-none" style="color:#7c3aed;">&larr; Back to events</a>

        <div class="card shadow-sm mt-3">
            <div class="card-body">

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <p class="text-muted small mb-1">
                    {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y g:i A') }}
                    &mdash;
                    {{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y g:i A') }}
                </p>
                <p class="text-muted small">{{ $event->location }}</p>

                <p class="mt-3">{{ $event->description }}</p>

                <div class="d-flex justify-content-between align-items-center rounded p-3 mt-3" style="background-color:#f5f3ff;">
                    <span class="fw-medium" style="color:#7c3aed;">
                        {{ $slotsLeft }} {{ Str::plural('slot', $slotsLeft) }} left
                    </span>
                </div>

                <div class="mt-4">
                    @if ($alreadyRegistered)
                        <p class="text-muted small mb-1">You're already registered for this event.</p>
                        <a href="{{ route('registrations.mine') }}" class="fw-medium text-decoration-none" style="color:#7c3aed;">
                            View my ticket &rarr;
                        </a>
                    @elseif ($slotsLeft === 0)
                        <button disabled class="btn btn-secondary w-100">Event Full</button>
                    @else
                        <form action="{{ route('events.register', $event) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 text-white" style="background-color:#c026d3;">
                                Register for this Event
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>