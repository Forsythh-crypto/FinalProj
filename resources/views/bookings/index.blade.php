<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Bookings
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        {{-- Booking Table --}}
        <table class="w-full bg-white shadow rounded overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3">Title</th>
                    <th class="text-left p-3">Date</th>
                    <th class="text-left p-3">Time</th>
                    <th class="text-left p-3">Duration</th>
                    <th class="text-left p-3">Status</th>
                    <th class="text-left p-3">Created By</th>
                    <th class="text-left p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3">{{ $booking->title }}</td>
                        <td class="p-3">{{ $booking->date }}</td>
                        <td class="p-3">{{ $booking->time }}</td>
                        <td class="p-3">{{ $booking->duration }} min</td>
                        <td class="p-3 capitalize">{{ $booking->status }}</td>
                        <td class="p-3">{{ $booking->user->name ?? '—' }}</td>

                        <td class="p-3 flex gap-2">
                            {{-- Edit Button --}}
                            <a href="{{ route('mybookings.edit', $booking) }}" class="text-blue-600 hover:underline">Edit</a>

                            {{-- Delete Form --}}
                            <form action="{{ route('mybookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Delete this booking?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Handle No Bookings --}}
        @if ($bookings->isEmpty())
            <p class="text-center text-gray-500 p-4">No bookings found.</p>
        @endif
    </div>
</x-app-layout>
