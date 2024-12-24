<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreRequest;
use App\Http\Requests\Feedback\UpdateRequest;
use App\Models\Star;
use App\Models\Hotel;
use App\Models\Booking;
use App\Models\Feedback;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index(Hotel $hotel)
    {
        $feedbacks = Feedback::where('hotel_id', $hotel->id)->get();

        return view('feedbacks.index', compact('feedbacks', 'hotel'));
    }

    public function create(Hotel $hotel, User $user)
    {
        $this->authorize('create', [Feedback::class, Booking::class]);

        $stars = Star::all();

        return view('feedbacks.form', compact('hotel', 'stars'));
    }

    public function store(Hotel $hotel, StoreRequest $request)
    {
        $feedbacks = Feedback::where('hotel_id', $hotel->id)->get();
        $stars = Star::all();

        foreach($feedbacks as $feedback) {
            if(auth()->user()->id === $feedback->user_id) {
                return view('feedbacks.edit', compact('feedback', 'hotel', 'stars'));
            }
        }

        $feedback = new Feedback($request->all());
        $feedback->hotel_id = $hotel->id;
        $feedback->user_id = Auth::user()->id;
        $feedback->save();

        return to_route('feedbacks.index', $hotel->id);
    }

    public function edit(Hotel $hotel, Feedback $feedback)
    {
        $this->authorize('update', $feedback);

        $hotel = Hotel::where('id', $feedback->hotel_id)->first();
        $stars = Star::all();

        return view('feedbacks.edit', compact('feedback', 'hotel', 'stars'));
    }

    public function update(Hotel $hotel, Feedback $feedback, UpdateRequest $request)
    {
        $this->authorize('update', $feedback);

        Feedback::find($feedback->id)
                ->update([
                    'star_id' => $request->star_id,
                    'message' => $request->message
                ]);

        return to_route('feedbacks.index', compact('hotel'));
    }
}
