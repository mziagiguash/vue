<?php

namespace App\Admin\Widgets;


use Arrilot\Widgets\AbstractWidget;
use App\Models\Hotel;

class HotelManagementController extends AbstractWidget
{
    public function run()
    {
        // Получаем количество отелей
        $count = Hotel::count();  // Считаем количество отелей

        // Переходим к представлению, передавая переменную $count
        return view('voyager::widgets.hotel_management', compact('count'));
    }


    /**
     * Determines whether the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return true;
    }
}
