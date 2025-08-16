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
     * Get the event tickets for this event.
     */
    public function eventTickets(): HasMany
    {
        return $this->hasMany(EventTicket::class);
    }
}
