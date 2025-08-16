<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BookingPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Booking $booking): bool
    {
        // Users can view their own bookings or admins can view any booking
        return $user->id === $booking->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Booking $booking): bool
    {
        // Users can update their own bookings (including guests)
        // Admins can update any booking
        return $user->id === $booking->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Booking $booking): bool
    {
        // Users can delete their own bookings (including guests)
        // Admins can delete any booking
        return $user->id === $booking->user_id || $user->is_admin;
    }
}