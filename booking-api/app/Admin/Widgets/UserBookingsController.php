<?php

namespace App\Admin\Widgets;


use App\Models\User;
use TCG\Voyager\Widgets\BaseDimmer;

class UserBookingsController extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The method that runs the widget.
     *
     * @return mixed
     */
    public function run()
    {
        // Получаем количество
        $count = User::count();

        // Возвращаем представление с количеством
        return view('voyager::dimmer', compact('count'));
    }

    /**
     * Determines whether the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        // Условие для отображения виджета
        return true; // Измените на ваше условие, если необходимо
    }
}
