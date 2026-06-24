<x-app-layout>
    <x-slot name="header"><h2 class="h5 mb-0">New Event</h2></x-slot>
    <div class="container py-4">
        <div class="card shadow-sm border-0"><div class="card-body p-4">
            <form method="POST" action="{{ route('admin.events.store') }}">
                @include('admin.events._form')
                <button class="btn btn-primary">Create Event</button>
                <a href="{{ route('admin.events.index') }}" class="btn btn-link">Cancel</a>
            </form>
        </div></div>
    </div>
</x-app-layout>