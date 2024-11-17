<?php

namespace App\Admin\Widgets;

use TCG\Voyager\Widgets\BaseDimmer;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class BookingManagementController extends BaseDimmer
{
    protected $config = [];

    /**
     * Run the widget.
     *
     * @return mixed
     */
    public function run()
    {
        // Здесь можно добавить логику для получения информации
        $count = Booking::count(); // Например, количество записей в таблице Booking

        // Вернём представление с данными
        return view('voyager::dimmer', [
            'icon' => 'voyager-alarm',
            'title' => "{$count} Bookings",
            'text' => "You have {$count} bookings in your database.",
            'button' => [
                'text' => __('View all bookings'),
                'link' => route('voyager.bookings.index'),
            ],
        ]);
    }

    /**
     * Determines whether the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return Auth::user()->can('browse', Booking::class);
    }
}
