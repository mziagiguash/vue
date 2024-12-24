<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::paginate(5); // Загрузка всех бронирований с пагинацией по 5 записей на странице

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        // Возвращаем представление для создания новой брони
        $statuses = Status::all(); // Получаем все статусы для отображения в форме
        return view('bookings.create', compact('statuses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'started_at' => 'required|date_format:Y-m-d H:i:s',
            'finished_at' => 'required|date_format:Y-m-d H:i:s',
            'room_id' => 'required|integer',
            'user_id' => 'required|integer',
            'status_id' => 'required|integer', // Новое поле для статуса бронирования
        ]);

        Booking::create([
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
            'room_id' => $request->room_id,
            'user_id' => Auth::id(), // Используем Auth для хранения ID текущего пользователя
            'status_id' => $request->status_id, // Связываем статус с бронированием
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('bookings.index')->with('success', 'Бронирование успешно создано.');
    }
    public function show($id)
    {
        $booking = Booking::findOrFail($id); // Поиск бронирования по ID
        return view('bookings.show', compact('booking')); // Возврат представления с данными
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id); // Поиск бронирования по ID
        $statuses = Status::all(); // Получаем все статусы для отображения в форме

        return view('bookings.edit', compact('booking', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'started_at' => 'required|date_format:Y-m-d H:i:s',
            'finished_at' => 'required|date_format:Y-m-d H:i:s',
            'room_id' => 'required|integer',
            'user_id' => 'required|integer',
            'status_id' => 'required|integer', // Новое поле для статуса бронирования
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update([
            'started_at' => $request->started_at,
            'finished_at' => $request->finished_at,
            'room_id' => $request->room_id,
            'user_id' => Auth::id(), // Используем Auth для хранения ID текущего пользователя
            'status_id' => $request->status_id, // Обновляем статус
            'updated_at' => now(),
        ]);

        return redirect()->route('bookings.index')->with('success', 'Бронирование успешно обновлено.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id); // Поиск бронирования по ID
        $booking->delete(); // Удаление записи

        return redirect()->route('bookings.index')->with('success', 'Бронирование успешно удалено.');
    }
}
