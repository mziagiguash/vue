<?php

namespace App\Http\Controllers\Admin;

use App\Models\Status;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\UpdateRequest;
use Illuminate\Support\Facades\Redirect;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);  // Ensure authorization is applied

        // Load relationships to prevent null issues
        $booking->load('room.hotel', 'user', 'status');

        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $statuses = Status::all();

        return view('admin.bookings.edit', compact('booking', 'statuses'));
    }

    public function update(Booking $booking, UpdateRequest $request)
    {
        $booking = Booking::find($booking->id)->update($request->all());

        return to_route('admin.bookings');
    }
}
