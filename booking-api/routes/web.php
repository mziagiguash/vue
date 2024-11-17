<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\FeedbackController;
use TCG\Voyager\Facades\Voyager;
use App\Models\Hotel;
use App\Http\Controllers\BookingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Добавляем маршрут для отображения списка отелей
    Route::get('/hotels', [HotelController::class, 'index'])->name('voyager.hotels.index');

    // routes/voyager.php
    Route::get('/hotels/{hotel}', [\TCG\Voyager\Http\Controllers\VoyagerController::class, 'show'])->name('voyager.hotels.show');
});
// Страница списка бронирований
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

// Страница просмотра конкретного бронирования
Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('bookings.show');

// Страница для создания бронирования
Route::get('/bookings/create/{room}', [BookingController::class, 'create'])->name('bookings.create');

// Для обработки создания бронирования
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

// Страница для редактирования бронирования
Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');

// Для обновления бронирования
Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');

// Для удаления бронирования
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');

// Для отображения всех отелей
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');

// Для отображения одного отеля
Route::get('/hotel/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

// Для поиска отелей
Route::get('/hotels/search', [HotelController::class, 'search'])->name('hotels.search');

// Для фильтрации отелей
Route::get('/hotels/filter', [HotelController::class, 'filter'])->name('hotels.filter');

