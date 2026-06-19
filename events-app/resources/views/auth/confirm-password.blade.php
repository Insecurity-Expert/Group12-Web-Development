<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="card-title text-center mb-3">Confirm Password</h4>
                        <p class="text-muted small mb-4">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="mb-3">
                                <x-input-label for="password" :value="__('Password')" />
                                <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" />
                            </div>

                            <div class="d-grid">
                                <x-primary-button>{{ __('Confirm') }}</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
