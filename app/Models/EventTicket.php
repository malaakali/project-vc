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
}
