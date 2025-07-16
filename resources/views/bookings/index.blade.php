<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Manage Bookings
        </h2>
    </x-slot>

    <div class="w-screen min-h-screen bg-slate-900 py-8 px-6">
        <div class="max-w-7xl mx-auto">
            {{-- Booking Table --}}
            <table class="w-full bg-slate-700 shadow rounded overflow-hidden">
                <thead class="bg-slate-800">
                    <tr>
                        <th class="text-left text-gray-100 p-3">Title</th>
                        <th class="text-left text-gray-100 p-3">Date</th>
                        <th class="text-left text-gray-100 p-3">Time</th>
                        <th class="text-left text-gray-100 p-3">Duration</th>
                        <th class="text-left text-gray-100 p-3">Status</th>
                        <th class="text-left text-gray-100 p-3">Created By</th>
                        <th class="text-left text-gray-100 p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bookings as $booking)
                        <tr class="border-t border-slate-600 hover:bg-slate-700">
                            <td class="text-gray-100 p-3">{{ $booking->title }}</td>
                            <td class="text-gray-100 p-3">{{ $booking->date }}</td>
                            <td class="text-gray-100 p-3">{{ $booking->time }}</td>
                            <td class="text-gray-100 p-3">{{ $booking->duration }} min</td>
                            <td class="text-gray-100 p-3 capitalize">{{ $booking->status }}</td>
                            <td class="text-gray-100 p-3">{{ $booking->user->name ?? '—' }}</td>
                            <td class="p-3 flex gap-2">
                                <a href="{{ route('mybookings.edit', $booking) }}" class="text-blue-400 hover:underline">Edit</a>
                                <form action="{{ route('mybookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Delete this booking?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-slate-400 p-4">No bookings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-6 text-center">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</x-app-layout>