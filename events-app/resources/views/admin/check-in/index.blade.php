<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">{{ __('Admin Check-in') }}</h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Session Alerts -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        {{ session('info') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="card-title mb-0 h6">{{ __('Scan or Enter Registration Code') }}</h4>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('admin.check-in.process') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="registration_code" class="form-label fw-bold">{{ __('Registration Code') }}</label>
                                <input type="text" 
                                       class="form-control form-control-lg @error('registration_code') is-invalid @enderror" 
                                       id="registration_code" 
                                       name="registration_code" 
                                       placeholder="e.g. REG-123456" 
                                       value="{{ old('registration_code') }}" 
                                       required 
                                       autofocus>
                                
                                @error('registration_code')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text text-muted mt-2">
                                    {{ __('Type or scan the attendee\'s unique registration code to record their attendance.') }}
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Check In Attendee') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
