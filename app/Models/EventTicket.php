<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventTicket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'purchase_date',
        'visit_date',
        'quantity',
        'total_price',
        'status',
        'confirmation_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'purchase_date' => 'datetime',
        'visit_date' => 'date',
        'total_price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string, string>
     */
    protected $dates = [
        'purchase_date',
        'visit_date',
    ];

    /**
     * Get the user that owns the event ticket.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event associated with the ticket.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Check if the event ticket is eligible for cancellation.
     */
    public function isEligibleForCancellation(): bool
    {
        // Assuming tickets can be cancelled up to 24 hours before the event
        return $this->visit_date > now()->addDay() && 
               $this->status === 'active';
    }

    /**
     * Get the total number of participants for this ticket.
     */
    public function getParticipantCount(): int
    {
        return $this->quantity;
    }
}
