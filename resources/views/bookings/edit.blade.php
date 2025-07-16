<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edit Booking
        </h2>
    </x-slot>

    <div class="w-screen min-h-screen bg-slate-900 py-8 px-6">
        <div class="max-w-3xl mx-auto bg-slate-800 p-6 rounded-xl shadow-lg text-white">
            <form method="POST" action="{{ route('mybookings.update', $booking) }}">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div class="mb-4 bg-red-200 text-red-900 border border-red-400 rounded p-4">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-white">Title</label>
                        <input type="text" name="title" value="{{ old('title', $booking->title) }}"
                            class="w-full mt-1 bg-slate-700 text-white border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white">Date</label>
                        <input type="date" name="date" value="{{ old('date', $booking->date) }}"
                            class="w-full mt-1 bg-slate-700 text-white border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white">Time</label>
                        <input type="time" name="time" value="{{ old('time', $booking->time) }}"
                            class="w-full mt-1 bg-slate-700 text-white border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-white">Duration (minutes)</label>
                        <input type="number" name="duration" value="{{ old('duration', $booking->duration) }}"
                            class="w-full mt-1 bg-slate-700 text-white border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-white">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full mt-1 bg-slate-700 text-white border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $booking->description) }}</textarea>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-white">Status</label>
                        <select name="status"
                            class="w-full mt-1 bg-slate-700 text-white border-slate-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="pending" {{ old('status', $booking->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="upcoming" {{ old('status', $booking->status) === 'upcoming' ? 'selected' : '' }}>Upcoming</option>
                            <option value="completed" {{ old('status', $booking->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 text-right">
                    <a href="{{ route('dashboard') }}" class="text-sm text-slate-400 hover:underline mr-4">Cancel</a>
                    <button type="submit"
                        class="inline-block bg-blue-600 text-white px-5 py-2 rounded shadow hover:bg-blue-700 transform transition duration-200 hover:scale-105">
                        💾 Update Booking
                    </button>
                </div>
            </form>

            {{-- Delete Button --}}
            <form action="{{ route('mybookings.destroy', $booking) }}" method="POST" class="mt-4 text-center">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-block bg-red-600 text-white px-5 py-2 rounded shadow hover:bg-red-700 transform transition duration-200 hover:scale-105">
                    🗑️ Delete Booking
                </button>
            </form>
        </div>
    </div>
</x-app-layout>