<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-blue-100 to-green-100 px-4">
        <div class="w-full max-w-md bg-white/90 backdrop-blur-sm p-6 rounded-xl shadow-md">
            <!-- Laravel Logo -->
            <div class="flex justify-center mb-4">
                <x-application-logo class="w-10 h-10 text-gray-700" />
            </div>

            <h2 class="text-2xl font-semibold text-center text-green-800 mb-6">Register</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" required autofocus :value="old('name')"
                        class="w-full px-4 py-2 text-sm rounded border border-green-300 bg-white" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" required :value="old('email')"
                        class="w-full px-4 py-2 text-sm rounded border border-green-300 bg-white" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" name="password" type="password" required
                        class="w-full px-4 py-2 text-sm rounded border border-green-300 bg-white" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                        class="w-full px-4 py-2 text-sm rounded border border-green-300 bg-white" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs" />
                </div>

                <button type="submit"
                    class="w-full py-2 text-sm font-semibold bg-green-700 hover:bg-green-800 text-white rounded transition-all">
                    Register
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-600">
                Already registered?
                <a href="{{ route('login') }}" class="text-green-700 font-semibold hover:underline">Log in</a>
            </p>
        </div>
    </div>
</x-guest-layout>
