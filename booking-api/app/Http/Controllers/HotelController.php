<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    // Метод для отображения списка отелей
    public function index()
    {
        $hotels = Hotel::all();
        return view('hotels.index', compact('hotels'));
    }

    // Метод для отображения конкретного отеля
    public function show(Hotel $hotel)
    {
        // Получаем список доступных комнат для данного отеля
        $rooms = $hotel->rooms()->get();

        // Передаем данные в представление
        return view('hotels.show', compact('hotel', 'rooms'));
    }

    // Метод для поиска отелей с учетом фильтров
    public function search(Request $request)
    {
        // Получаем введённые пользователем параметры
        $destination = $request->input('destination');
        $check_in_date = $request->input('check_in_date');
        $check_out_date = $request->input('check_out_date');
        $adults = $request->input('adults');
        $facilities = $request->input('facilities', []);  // Получаем фильтр по удобствам (если есть)

        // Строим запрос для поиска отелей
        $hotels = Hotel::where('location', 'like', "%{$destination}%")
            ->whereHas('rooms', function ($query) use ($check_in_date, $check_out_date) {
                $query->whereHas('bookings', function ($query) use ($check_in_date, $check_out_date) {
                    $query->where('finished_at', '>=', $check_in_date)
                        ->where('started_at', '<=', $check_out_date);
                });
            });

        // Если указаны удобства, фильтруем отели, которые их предлагают
        if (!empty($facilities)) {
            $hotels = $hotels->whereHas('facilities', function ($query) use ($facilities) {
                $query->whereIn('id', $facilities);
            });
        }

        // Получаем результат
        $hotels = $hotels->get();

        // Возвращаем представление с найденными отелями
        return view('hotels.index', compact('hotels'));
    }

    // Дополнительный метод для фильтрации отелей по другим параметрам
    public function filter(Request $request)
    {
        $query = Hotel::query();

        // Применяем фильтры
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
        if ($request->has('address')) {
            $query->where('address', 'like', '%' . $request->input('address') . '%');
        }

        $hotels = $query->get();

        // Возвращаем представление с отфильтрованными отелями
        return view('vendor.voyager.widgets.hotels_list', compact('hotels'));
    }
}

