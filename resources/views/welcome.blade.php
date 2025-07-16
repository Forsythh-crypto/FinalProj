<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Booking System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 font-sans antialiased text-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4 bg-slate-900">
        <div class="w-full max-w-xl bg-gray-800 shadow-[0_10px_40px_rgba(0,0,0,0.4)] rounded-xl p-8 text-center transition-all duration-500">

            <!-- Header -->
            <h1 class="text-3xl font-extrabold text-blue-300 mb-4">
                Welcome to Booking System
            </h1>
            <p class="text-gray-300 text-base mb-6">
                Plan, schedule, and manage your bookings with ease.
            </p>

            <!-- CTA Buttons -->
            <div class="flex justify-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                       class="bg-blue-800 hover:bg-blue-900 text-white font-semibold py-2 px-6 rounded-lg shadow hover:scale-105 transition">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="bg-green-900 hover:bg-green-800 text-white font-semibold py-2 px-6 rounded-lg shadow transition hover:scale-105">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-gray-700 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg border border-gray-500 transition hover:scale-105">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Footer -->
            <div class="mt-10 text-sm text-gray-500">
                &copy; {{ now()->year }} Booking System PH. Built by Gabriel Cayabyab.
            </div>
        </div>
    </div>

</body>
</html>