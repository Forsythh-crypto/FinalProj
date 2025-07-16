<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="flex bg-slate-900 min-h-screen">

        @auth
            @if(auth()->user()->id === 1)
                {{-- Sidebar --}}
                <div class="w-60- bg-gray-800 text-white p-4 rounded-xl shadow-lg h-auto">
                    <h3 class="text-lg font-semibold mb-6">Admin Panel</h3>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('mybookings.index') }}" class="block p-3 rounded hover:bg-gray-700 transition">Manage Bookings</a>
                        </li>
                        <li>
                            <a href="{{ route('users.index') }}" class="block p-3 rounded hover:bg-gray-700 transition">Show All Users</a>
                        </li>
                    </ul>
                </div>
            @endif
        @endauth

        {{-- Main Content --}}
        <div class="flex-1 p-6 max-w-7xl mx-auto sm:px-6 lg:px-8 text-blue-300">
            {{-- Booking Summary --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                <div class="bg-gray-800 border-l-4 border-green-600 rounded p-4 shadow hover:scale-105 transition">
                    <div class="text-sm text-gray-400">Total Bookings</div>
                    <div class="text-2xl font-bold">{{ $stats['total'] }}</div>
                </div>
                <div class="bg-gray-800 border-l-4 border-blue-500 rounded p-4 shadow hover:scale-105 transition">
                    <div class="text-sm text-gray-400">Upcoming</div>
                    <div class="text-2xl font-bold">{{ $stats['upcoming'] }}</div>
                </div>
                <div class="bg-gray-800 border-l-4 border-yellow-500 rounded p-4 shadow hover:scale-105 transition">
                    <div class="text-sm text-gray-400">Pending</div>
                    <div class="text-2xl font-bold">{{ $stats['pending'] }}</div>
                </div>
                <div class="bg-gray-800 border-l-4 border-gray-500 rounded p-4 shadow hover:scale-105 transition">
                    <div class="text-sm text-gray-400">Completed</div>
                    <div class="text-2xl font-bold">{{ $stats['completed'] }}</div>
                </div>
                <div class="bg-gray-800 border-l-4 border-indigo-500 rounded p-4 shadow hover:scale-105 transition">
                    <div class="text-sm text-gray-400">Total Users</div>
                    <div class="text-2xl font-bold">{{ $stats['users'] }}</div>
                </div>
            </div>

            {{-- Calendar --}}
            <div id="calendar" class="bg-gray-800 p-4 rounded shadow mb-6 hover:shadow-xl transition"></div>
        </div>
    </div>

    {{-- FullCalendar Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                height: "auto",
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                select: function (info) {
                    Swal.fire({
                        title: 'Create a New Booking',
                        html:
                            `<input id="swal-title" class="swal2-input" placeholder="Enter booking title">
                             <input id="swal-time" type="time" class="swal2-input" placeholder="Select time">
                             <input id="swal-duration" type="number" class="swal2-input" placeholder="Duration (in minutes)">
                             <textarea id="swal-description" class="swal2-textarea" placeholder="Add a description"></textarea>`,
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        cancelButtonText: 'Cancel',
                        preConfirm: () => {
                            const title = document.getElementById('swal-title').value;
                            const time = document.getElementById('swal-time').value;
                            const duration = document.getElementById('swal-duration').value;
                            const description = document.getElementById('swal-description').value;

                            if (!title || !time || !duration) {
                                Swal.showValidationMessage('Please fill in all required fields.');
                                return false;
                            }

                            return { title, time, duration, description };
                        }
                    }).then(result => {
                        if (result.isConfirmed && result.value) {
                            fetch("{{ route('mybookings.store') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                    "X-Requested-With": "XMLHttpRequest"
                                },
                                body: JSON.stringify({
                                    title: result.value.title,
                                    date: info.startStr,
                                    time: result.value.time,
                                    duration: result.value.duration,
                                    description: result.value.description
                                })
                            })
                            .then(async res => {
                                if (!res.ok) {
                                    const err = await res.json();
                                    throw new Error(err.message || 'Failed to create booking.');
                                }
                                return res.json();
                            })
                           .then(data => {
                                Swal.fire({
                                    title: "Success",
                                    text: "Booking created successfully!",
                                    icon: "success",
                                    confirmButtonText: "OK"
                                }).then(result => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });

    calendar.addEvent({
        title: data.booking.title,
        start: `${data.booking.date}T${data.booking.time}`,
        url: `/bookings/${data.booking.id}/edit`
    });
})
                            .catch(err => {
                                console.error(err);
                                Swal.fire("Error", err.message || "Something went wrong", "error");
                            });
                        }
                    });
                },
                events: [
                    @foreach ($bookings as $booking)
                    {
                        title: '{{ $booking->title }}',
                        start: '{{ $booking->date }}T{{ $booking->time }}',
                        url: '{{ route('mybookings.edit', $booking) }}'
                    },
                    @endforeach
                ]
            });

            calendar.render();
        });
    </script>
</x-app-layout>