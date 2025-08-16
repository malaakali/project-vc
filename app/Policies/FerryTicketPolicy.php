<?php

namespace App\Policies;

use App\Models\FerryTicket;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FerryTicketPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FerryTicket $ferryTicket): bool
    {
        // Users can view their own ferry tickets or admins can view any ticket
        return $user->id === $ferryTicket->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FerryTicket $ferryTicket): bool
    {
        // Users can update their own ferry tickets (including guests)
        // Admins can update any ticket
        return $user->id === $ferryTicket->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FerryTicket $ferryTicket): bool
    {
        // Users can delete their own ferry tickets (including guests)
        // Admins can delete any ticket
        return $user->id === $ferryTicket->user_id || $user->is_admin;
    }
}