<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class FacilitiesWidget extends AbstractWidget
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
        //

        return view('widgets.facilities_widget', [
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
        // Проверка роли пользователя через role_id
        return auth()->check() && auth()->user()->role_id === 1;
    }
}
