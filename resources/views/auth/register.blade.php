<x-guest-layout>
    <div class="h-screen w-screen flex items-center justify-center bg-gray-900 px-4">
        <div class="w-full max-w-md bg-gray-800 p-6 rounded-lg shadow-md text-white">
            <h2 class="text-xl font-bold text-green-400 mb-4 text-center">Register</h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-3">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" class="text-green-500" />
                    <x-text-input id="name" class="w-full px-4 py-2 text-sm bg-gray-700 text-white border border-green-500 rounded" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400 text-xs" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-green-500" />
                    <x-text-input id="email" class="w-full px-4 py-2 text-sm bg-gray-700 text-white border border-green-500 rounded" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400 text-xs" />
                </div>

                <div>
                    <x-input-label for="password" :value="__('Password')" class="text-green-500" />
                    <x-text-input id="password" class="w-full px-4 py-2 text-sm bg-gray-700 text-white border border-green-500 rounded" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-xs" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-green-500" />
                    <x-text-input id="password_confirmation" class="w-full px-4 py-2 text-sm bg-gray-700 text-white border border-green-500 rounded" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-400 text-xs" />
                </div>

                <button type="submit" class="w-full py-2 text-sm font-semibold bg-green-700 hover:bg-green-800 text-white rounded transition">
                    Register
                </button>
            </form>

            <p class="mt-4 text-center text-sm text-gray-400">
                Already registered?
                <a href="{{ route('login') }}" class="text-green-400 font-semibold hover:underline">Log in</a>
            </p>
        </div>
    </div>
</x-guest-layout>