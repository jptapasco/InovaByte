<x-guest-layout>

    <div class="bg-success justify-content-center p-5 rounded">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Correo')" />
                <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Contraseña')" />

                <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password"
                    name="password" required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="form-check mt-3 ">
                <input wire:model="form.remember" id="remember" name="remember" class="form-check-input"
                    type="checkbox" value="">
                <label class="form-check-label text-light" for="remember">
                    Recuerdame
                </label>
            </div>

            <div class="d-flex justify-content-end align-items-center mt-4">
                @if (Route::has('password.request'))
                    <a style="font-size: 14px; color: #FFFFFF; text-decoration: underline" class=""
                        href="{{ route('password.request') }}" wire:navigate>
                        {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
                <button class="btn btn-outline-light ms-3">
                    Ingresar
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
