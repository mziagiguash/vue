<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hotel;
use App\Models\Facility;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Hotel\StoreRequest;
use App\Http\Requests\Hotel\UpdateRequest;

class AdminHotelController extends Controller
{
    public function index()
{
    $hotels = Hotel::orderBy('id', 'desc')->paginate(20);
    $facilities = Facility::all();

    return view('admin.hotels.index', compact('hotels', 'facilities'));
}

    public function create()
    {
        $hotels = Hotel::orderBy('id', 'desc')->paginate(20);
        $facilities = Facility::all();

        return view('admin.hotels.index', compact('hotels', 'facilities'));
    }

    public function store(StoreRequest $request)
    {
        $hotel = new Hotel($request->all());
        if (!empty($request->file)) {
            $hotel->poster_url = Storage::disk('public')->put('hotels', $request->file('file'));
        };
        $hotel->save();

        $hotel->facilities()->attach($request->facility);

        return to_route('admin.hotels');
    }

    public function edit(Hotel $hotel)
    {
        $hotels = Hotel::find($hotel->id);
        $facilities = Facility::all();

        return view('admin.hotels.edit', compact('hotel', 'hotels', 'facilities'));
    }

    public function update(Hotel $hotel, UpdateRequest $request)
    {
        Hotel::find($hotel->id)->update($request->all());

        if (!empty($request->file) && !empty($hotel->poster_url)) {
            Storage::delete($hotel->poster_url);
            $hotel->poster_url = Storage::disk('public')->put('hotels', $request->file('file'));
        }

        $hotel->save();

        if (!empty($request->facility)) {
            $hotel->facilities()->sync($request->facility);
        }

        return to_route('admin.hotels');
    }

    public function destroy(Hotel $hotel)
    {
        if (!empty($hotel->poster_url)) {
            Storage::delete($hotel->poster_url);
        };
        Hotel::find($hotel->id)->delete();

        return to_route('admin.hotels');
    }
}
