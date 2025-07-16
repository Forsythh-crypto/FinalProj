<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="flex">
    @auth
        @if(auth()->user()->id === 1)
                {{-- Sidebar --}}
            <div class="w-64 bg-gradient-to-r from-green-500 to-blue-300 text-black p-4">
                <h3 class="text-lg font-semibold mb-6">Admin Panel</h3>
                <ul class="space-y-4">
                    <li>
                        <a href="{{ route('mybookings.index') }}" class="block p-3 hover:bg-indigo-700 rounded">Manage Bookings</a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="block p-3 hover:bg-indigo-700 rounded">Show All Users</a>
                    </li>
                </ul>
            </div>
        @endif
    @endauth

        {{-- Main Content --}}
        <div class="flex-1 p-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Booking Summary --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
                <div class="bg-gradient-to-r from-green-500 to-blue-300 shadow rounded p-4 hover:scale-105 transform transition duration-300 ease-in-out">
                    <div class="text-sm text-black">Total Bookings</div>
                    <div class="text-2xl font-bold text-black">{{ $stats['total'] }}</div>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-blue-300 shadow rounded p-4 hover:scale-105 transform transition duration-300 ease-in-out">
                    <div class="text-sm text-black">Upcoming</div>
                    <div class="text-2xl font-bold text-black">{{ $stats['upcoming'] }}</div>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-blue-300 shadow rounded p-4 hover:scale-105 transform transition duration-300 ease-in-out">
                    <div class="text-sm text-black">Pending</div>
                    <div class="text-2xl font-bold text-black">{{ $stats['pending'] }}</div>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-blue-300 shadow rounded p-4 hover:scale-105 transform transition duration-300 ease-in-out">
                    <div class="text-sm text-black">Completed</div>
                    <div class="text-2xl font-bold text-black">{{ $stats['completed'] }}</div>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-blue-300 shadow rounded p-4 hover:scale-105 transform transition duration-300 ease-in-out">
                    <div class="text-sm text-black">Total Users</div>
                    <div class="text-2xl font-bold text-black">{{ $stats['users'] }}</div>
    </div>
            </div>

            {{-- Calendar --}}
            <div id="calendar" class="bg-gradient-to-r from-green-500 to-blue-400 text-black p-4 rounded shadow mb-6 hover:shadow-2xl transform transition duration-300 ease-in-out"></div>
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
                // Handling the click on a date (for creating a booking)
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
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // Ensure CSRF is correct
                                    "X-Requested-With": "XMLHttpRequest"
                                },
                                body: JSON.stringify({
                                    title: result.value.title,
                                    date: info.startStr,  // Use the selected date from FullCalendar
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
                                Swal.fire("Success", "Booking created successfully!", "success");

                                // Add the new booking to FullCalendar
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
                // Pre-existing events (Bookings) from the database
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
