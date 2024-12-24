<?php

namespace App\Policies;

use App\Models\Hotel;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HotelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role_id == 1 || $user->role_id == 2;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Hotel $hotel): bool
    {
        return $user->role_id == 1 || ($user->role_id == 2 && $user->hotel_id === $hotel->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id == 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Hotel $hotel): bool
    {
        return $user->role_id == 1 || ($user->role_id == 2 && $user->hotel_id === $hotel->id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Hotel $hotel): bool
    {
        return $user->role_id == 1;
    }
}
