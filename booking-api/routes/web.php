<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\AdminHotelController;
use App\Http\Controllers\Admin\AdminBookingController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\FeedbackController;
use TCG\Voyager\Facades\Voyager;

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
Route::get('/hotels/filter', [HotelController::class, 'filter'])->name('hotels.filter');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

Route::middleware('auth')->group(function () {
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/booking/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('/booking/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/booking/{booking}', [BookingController::class, 'destroy'])->name('booking.delete');


    Route::prefix('admin')->middleware('admin')->as('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::resource('hotels', AdminHotelController::class)->except(['show']);

        Route::resource('bookings', AdminBookingController::class);  // Используйте переименованный контроллер

        Route::get('hotels/{hotel}/rooms/', [RoomController::class, 'create'])->name('hotels.rooms.create');
        Route::post('hotels/{hotel}/rooms/', [RoomController::class, 'store'])->name('hotels.rooms.store');
        Route::get('rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
        Route::patch('rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.delete');

        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::patch('/users/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        
        Route::get('/facilities', [FacilityController::class, 'create'])->name('facilities');
        Route::post('/facilities', [FacilityController::class, 'store'])->name('facilities.store');
        Route::get('/facilities/{facility}/edit', [FacilityController::class, 'edit'])->name('facilities.edit');
        Route::patch('/facilities/{facility}/update', [FacilityController::class, 'update'])
                ->name('facility.update');
        Route::delete('/facilities/{facility}/delete', [FacilityController::class, 'destroy'])->name('facilities.delete');
    });

});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

