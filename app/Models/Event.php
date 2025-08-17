<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'event_type',
        'location',
        'start_datetime',
        'end_datetime',
        'max_participants',
        'price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'price' => 'decimal:2',
        'max_participants' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array<string, string>
     */
    protected $dates = [
        'start_datetime',
        'end_datetime',
    ];

    /**
     * Get the event tickets for this event.
     */
    public function eventTickets(): HasMany
    {
        return $this->hasMany(EventTicket::class);
    }

    /**
     * Check if the event is available (not sold out).
     */
    public function isAvailable(): bool
    {
        if (!$this->max_participants) {
            return true; // No limit
        }

        $soldTickets = $this->eventTickets()
            ->where('status', 'active')
            ->sum('quantity');

        return $soldTickets < $this->max_participants;
    }

    /**
     * Get the number of available tickets.
     */
    public function availableTickets(): int
    {
        if (!$this->max_participants) {
            return PHP_INT_MAX; // No limit
        }

        $soldTickets = $this->eventTickets()
            ->where('status', 'active')
            ->sum('quantity');

        return max(0, $this->max_participants - $soldTickets);
    }
}
