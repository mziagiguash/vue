<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use App\Models\Hotel;

class HotelsWidget extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        // Получение всех гостиниц
        $hotels = Hotel::all();

        return view('widgets.hotels_widget', [
            'hotels' => $hotels, // Передача данных в представление
            'config' => $this->config,
        ]);
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed(): bool
    {
        // Проверка роли пользователя
        return auth()->check() && auth()->user()->role_id === 1; // Пример роли
    }
}

