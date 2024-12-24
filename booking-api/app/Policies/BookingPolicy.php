<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any bookings.
     */
    public function viewAny(User $user)
    {
        return $user->role_id === 1; // Доступ разрешен только админам
    }

    /**
     * Determine whether the user can view the booking.
     */
    public function view(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id || $user->role_id === 1; // Доступ к бронированию предоставляется владельцу бронирования или администратору
    }

    /**
     * Determine whether the user can create bookings.
     */
    public function create(User $user)
    {
        return $user->role_id === 1; // Доступ разрешен только админам
    }

    /**
     * Determine whether the user can update the booking.
     */
    public function update(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id || $user->role_id === 1; // Доступ к обновлению бронирования предоставляется владельцу или администратору
    }

    /**
     * Determine whether the user can delete the booking.
     */
    public function delete(User $user, Booking $booking)
    {
        return $user->id === $booking->user_id || $user->role_id === 1; // Доступ к удалению бронирования предоставляется владельцу или администратору
    }
}
