<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Facility;
use TCG\Voyager\Models\Menu;

class AdminController extends Controller
{
    public function index()
    {
        $countUsers = User::count();
        $countHotels = Hotel::count();
        $countFacilities = Facility::count();
        $countBookings = Booking::count();

        // Получаем меню с именем "admin"
        $menuItems = Menu::where('name', 'admin')->first()->items;
        return view('admin.index', compact('menuItems', 'countUsers', 'countHotels', 'countFacilities', 'countBookings'));

    }
}
