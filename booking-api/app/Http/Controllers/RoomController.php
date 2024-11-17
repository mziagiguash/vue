<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Hotel $hotel)
    {
        $rooms = $hotel->rooms; // Получаем все номера для отеля
        return view('rooms.index', compact('hotel', 'rooms'));
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function create(Hotel $hotel)
    {
        return view('rooms.create', compact('hotel'));
    }

    public function store(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'poster_url' => 'nullable|string|max:100',
            'floor_area' => 'required|numeric',
            'type' => 'required|string|max:100',
            'price' => 'required|integer',
        ]);

        $hotel->rooms()->create($data); // Создаем номер, связанный с отелем

        return redirect()->route('hotels.show', $hotel)->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'poster_url' => 'nullable|string|max:100',
            'floor_area' => 'required|numeric',
            'type' => 'required|string|max:100',
            'price' => 'required|integer',
        ]);

        $room->update($data);

        return redirect()->route('rooms.show', $room)->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('hotels.show', $room->hotel_id)->with('success', 'Room deleted successfully.');
    }
}
