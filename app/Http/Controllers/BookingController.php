<?php

namespace App\Http\Controllers;

use App\Models\Booking;  // Assuming you have a Booking model
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Show a listing of bookings
    public function index()
    {
        $bookings = Booking::paginate(10);  // Get bookings with pagination
        return view('bookings.index', compact('bookings'));  // Pass to the view
    }

    // Show the form for creating a new booking
    public function create()
    {
        return view('bookings.create');  // Add a view for creating a booking
    }

    // Store a newly created booking in storage
   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'duration' => 'required|integer',
        'description' => 'nullable|string',
    ]);

    // Create the booking
    $booking = Booking::create($validated);

    // Redirect back to the dashboard with updated bookings
    return redirect()->route('dashboard')->with('success', 'Booking created successfully!')
                                      ->with('bookings', Booking::all());
}


    // Show the form for editing the specified booking
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    // Update the specified booking in storage
   public function update(Request $request, Booking $booking)
{
    $validated = $request->validate([
        'title' => 'required|string',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'duration' => 'required|integer',
        'description' => 'nullable|string',
    ]);

    // Update the booking
    $booking->update($validated);

    // Redirect back to dashboard with updated bookings
    return redirect()->route('dashboard')->with('success', 'Booking updated successfully!')
                                      ->with('bookings', Booking::all());
}

    // Remove the specified booking from storage
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index');
    }
}
