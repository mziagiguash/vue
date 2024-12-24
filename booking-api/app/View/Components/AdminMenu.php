<?php

namespace App\View\Components;

use Illuminate\View\Component;
use TCG\Voyager\Models\Menu;

class AdminMenu extends Component
{
    public $menuItems;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Получаем элементы меню "admin"
        $this->menuItems = Menu::where('name', 'admin')
            ->first()
            ->items()
            ->orderBy('order')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.admin-menu');
    }
}
