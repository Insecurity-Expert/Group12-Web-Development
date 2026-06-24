<head><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}" style="color:var(--mc-primary);">
                <i class="bi bi-calendar2-event-fill"></i> {{ config('app.name', 'Convene') }}
            </a>
            <div class="ms-auto d-flex gap-2">
                <a href="{{ route('events.index') }}" class="btn btn-sm btn-outline-secondary">Browse Events</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">Log in</a>
                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    {{ $slot }}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="mc-footer">
    <div class="container text-center">
        &copy; {{ date('Y') }} {{ config('app.name', 'Convene') }} — Convene for Convenience. Built by Group 12.
    </div>
</footer>
</body>