<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">My Tickets</h2>
    </x-slot>

    <div class="container py-4">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($registrations->isEmpty())
            <div class="card shadow-sm">
                <div class="card-body text-center text-muted py-5">
                    You haven't registered for any events yet.
                    <br>
                    <a href="{{ route('events.index') }}" class="fw-medium text-decoration-none" style="color:#7c3aed;">
                        Browse events &rarr;
                    </a>
                </div>
            </div>
        @else
            @foreach ($registrations as $registration)
                <div class="card shadow-sm mb-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-1">{{ $registration->event->title }}</h5>
                            <p class="text-muted small mb-1">
                                {{ \Carbon\Carbon::parse($registration->event->start_date)->format('M d, Y g:i A') }}
                                &middot; {{ $registration->event->location }}
                            </p>
                            <p class="small mb-0">
                                Status:
                                <span class="fw-medium {{ $registration->status === 'confirmed' ? 'text-success' : 'text-muted' }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                                @if ($registration->is_checked_in)
                                    &middot; <span class="fw-medium" style="color:#7c3aed;">Checked in</span>
                                @endif
                            </p>
                        </div>
                        <div class="text-end">
                            <p class="text-muted small mb-0">Ticket Code</p>
                            <p class="fw-bold mb-0" style="color:#c026d3; font-family: monospace; font-size: 1.1rem;">
                                {{ $registration->registration_code }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</x-app-layout>