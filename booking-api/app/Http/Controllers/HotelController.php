<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Filters\HotelFilter;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::with('rooms', 'facilities')->paginate(20);
        $facilities = Facility::all();

        return view('hotels.index', compact('hotels', 'facilities'));
    }

    public function filter(Request $request)
    {
        $facilities = Facility::all();

        $data = $request->all();
        $filter = app()->make(HotelFilter::class, ['queryParams' => array_filter($data)]);
        $hotels = Hotel::filter($filter)->paginate(20);

        return view('hotels.index', compact('hotels', 'facilities'));
    }

    public function show(Hotel $hotel)
    {
        $rooms = Room::where('hotel_id', $hotel->id)->get();

        return view('hotels.show', compact('rooms', 'hotel'));
    }
}
