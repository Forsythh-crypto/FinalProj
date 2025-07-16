<x-guest-layout>
    <div class="h-screen w-screen flex items-center justify-center bg-gray-900 px-2">
        <div class="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-md text-white">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-blue-300 mt-2">Welcome Back</h1>
                <p class="text-gray-400 text-sm">Log in to continue managing your bookings</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-blue-300" />
                    <x-text-input id="email" class="block mt-1 w-full px-4 py-2 text-sm bg-gray-700 text-white border border-blue-500 rounded" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-blue-300" />
                    <x-text-input id="password" class="block mt-1 w-full px-4 py-2 text-sm bg-gray-700 text-white border border-blue-500 rounded" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
                </div>

                <div class="flex items-center justify-between mb-6">
                    <label class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-500 text-indigo-500 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-400 hover:underline" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-2 rounded transition">
                    Log in
                </button>
            </form>

            <p class="mt-6 text-sm text-center text-gray-400">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-blue-400 font-semibold hover:underline">Register now</a>
            </p>
        </div>
    </div>
</x-guest-layout>