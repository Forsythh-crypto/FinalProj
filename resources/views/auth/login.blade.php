<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-100 to-green-100 flex items-center justify-center px-4">
        <div class="w-full max-w-sm bg-white/90 backdrop-blur-sm p-6 rounded-xl shadow-md">
            <!-- Laravel Logo -->
            <div class="flex justify-center mb-4">
                <x-application-logo class="w-10 h-10 text-gray-700" />
            </div>

            <h2 class="text-xl font-bold text-blue-900 mb-4 text-center">Log in</h2>

            <x-auth-session-status class="mb-2" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                        class="w-full px-4 py-2 text-sm rounded border border-blue-300 bg-white" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 text-sm rounded border border-blue-300 bg-white" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <button type="submit"
                    class="w-full py-2 text-sm font-semibold bg-blue-800 hover:bg-blue-900 text-white rounded transition-all">
                    Log in
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                <a href="{{ route('register') }}" class="text-blue-700 font-semibold hover:underline">Register</a>
            </p>
        </div>
    </div>
</x-guest-layout>
