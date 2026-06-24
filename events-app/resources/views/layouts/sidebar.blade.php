<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Convene') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="mc-layout">
        <aside class="mc-sidebar d-none d-md-block">
            <a href="{{ route('dashboard') }}" class="mc-brand">
                <i class="bi bi-calendar2-event-fill"></i> {{ config('app.name', 'Convene') }}
            </a>
            <ul class="nav flex-column">
                <li><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a></li>
                <li><a class="nav-link {{ request()->routeIs('events.*') ? 'active' : '' }}" href="{{ route('events.index') }}"><i class="bi bi-calendar-event"></i> Events</a></li>
                <li><a class="nav-link {{ request()->routeIs('registrations.*') ? 'active' : '' }}" href="{{ route('registrations.mine') }}"><i class="bi bi-ticket-perforated"></i> My Tickets</a></li>
                @if (auth()->user()->role === 'admin')
                    <li class="text-muted small px-3 mt-3 mb-1">ADMIN</li>
                    <li><a class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}"><i class="bi bi-pencil-square"></i> Manage Events</a></li>
                    <li><a class="nav-link {{ request()->routeIs('admin.check-in.*') ? 'active' : '' }}" href="{{ route('admin.check-in.index') }}"><i class="bi bi-check2-square"></i> Check-in</a></li>
                    <li><a class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}"><i class="bi bi-bar-chart"></i> Reports</a></li>
                @endif
            </ul>
        </aside>

        <div class="mc-main">
            <div class="mc-topbar">
                <div>
                    {{-- mobile brand --}}
                    <a href="{{ route('dashboard') }}" class="d-md-none fw-bold text-decoration-none" style="color:var(--mc-primary);">
                        <i class="bi bi-calendar2-event-fill"></i> {{ config('app.name') }}
                    </a>
                    @isset($header)<span class="d-none d-md-inline">{{ $header }}</span>@endisset
                </div>
                <div class="dropdown">
                    <a class="text-decoration-none dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                        <span class="rounded-circle d-inline-flex align-items-center justify-content-center text-white"
                              style="width:32px;height:32px;background:var(--mc-primary);">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </span>
                        <span class="d-none d-sm-inline text-dark">{{ auth()->user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">@csrf
                                <button class="dropdown-item" type="submit">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <main class="p-3 p-md-4">{{ $slot }}</main>
        <footer class="mc-footer">
            <div class="container text-center">
                &copy; {{ date('Y') }} {{ config('app.name', 'Convene') }} — Convene for Convenience. Built by Group 12.
            </div>
        </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>