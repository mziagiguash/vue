<?php

namespace App\Http\Controllers\Admin;

use App\Models\Room;
use App\Models\Hotel;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRequest;
use App\Http\Requests\Room\UpdateRequest;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function create(Hotel $hotel)
    {
        $rooms = Room::where('hotel_id', $hotel->id)->get();
        $facilities = Facility::all();

        return view('admin.rooms.index', compact('rooms', 'hotel', 'facilities'));
    }

    public function store(StoreRequest $request, Hotel $hotel)
    {
        $room = new Room($request->all());
        $room->hotel_id = $hotel->id;
        if (!empty($request->file)) {
            $room->poster_url = Storage::disk('public')->put('rooms', $request->file('file'));
        };
        $room->save();
        $room->facilities()->attach($request->facility);

        return to_route('admin.hotels.rooms.create', compact('hotel'));
    }

    public function edit(Room $room, Hotel $hotel)
    {
        $facilities = Facility::all();

        return view('admin.rooms.edit', compact('room', 'hotel', 'facilities'));
    }

    public function update(UpdateRequest $request, Room $room)
    {
        Room::find($room->id)->update($request->all());

        if (isset($request->file)) {
            if (!empty($room->poster_url)) {
                Storage::delete($room->poster_url);
            }
            $room->poster_url = Storage::disk('public')->put('rooms', $request->file('file'));
        }

        $room->save();
        $hotel = $room->hotel_id;
        $room->facilities()->sync($request->facility);

        return to_route('admin.hotels.rooms.create', compact('hotel'));
    }

    public function destroy(Room $room)
    {
        if (!empty($room->poster_url)) {
            Storage::delete($room->poster_url);
        };

        Room::find($room->id)->delete();
        $hotel = $room->hotel_id;

        return to_route('admin.hotels.rooms.create', compact('hotel'));
    }
}
