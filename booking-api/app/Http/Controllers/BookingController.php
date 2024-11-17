<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\Hotel;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Конструктор без использования middleware
    // public function __construct()
    // {
    //     $this->middleware('auth');  // Уберите этот вызов, чтобы методы были доступны без авторизации
    // }

    public function index()
{
    $bookings = Booking::with('room.hotel')->get(); // Загружаем связанные данные room и hotel

    return view('bookings.index', compact('bookings'));
}
public function search(Request $request)
    {
        // Получаем данные из запроса
        $destination = $request->get('destination');
        $checkInDate = $request->get('check_in_date');
        $checkOutDate = $request->get('check_out_date');
        $adults = $request->get('adults', 2);
        $facilities = $request->get('facilities', []);

        // Строим запрос к базе данных
        $hotelsQuery = Hotel::query();

        if ($destination) {
            $hotelsQuery->where('destination', 'like', '%' . $destination . '%');
        }

        if ($checkInDate && $checkOutDate) {
            $hotelsQuery->where('check_in_date', '>=', $checkInDate)
                        ->where('check_out_date', '<=', $checkOutDate);
        }

        if ($facilities) {
            $hotelsQuery->whereHas('facilities', function ($query) use ($facilities) {
                $query->whereIn('id', $facilities);
            });
        }

        $hotels = $hotelsQuery->get();

        // Получаем список всех удобств
        $facilitiesList = Facility::all();

        return view('hotels.search', compact('hotels', 'facilitiesList'));
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function create(Room $room)
    {
        return view('bookings.create', compact('room'));
    }

    public function store(Request $request, Room $room)
    {
        $data = $request->validate([
            'started_at' => 'required|date',
            'finished_at' => 'required|date|after:started_at',
        ]);

        $days = now()->parse($data['finished_at'])->diffInDays(now()->parse($data['started_at']));
        $price = $days * $room->price;

        Booking::create([
            'room_id' => $room->id,
            'user_id' => Auth::id(),
            'started_at' => $data['started_at'],
            'finished_at' => $data['finished_at'],
            'days' => $days,
            'price' => $price,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'started_at' => 'required|date',
            'finished_at' => 'required|date|after:started_at',
        ]);

        $days = now()->parse($data['finished_at'])->diffInDays(now()->parse($data['started_at']));
        $price = $days * $booking->room->price;

        $booking->update([
            'started_at' => $data['started_at'],
            'finished_at' => $data['finished_at'],
            'days' => $days,
            'price' => $price,
        ]);

        return redirect()->route('bookings.show', $booking)->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
