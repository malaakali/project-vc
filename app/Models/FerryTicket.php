<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FerryTicket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'schedule_id',
        'booking_id',
        'purchase_date',
        'departure_date',
        'number_of_passengers',
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
        'departure_date' => 'date',
        'total_price' => 'decimal:2',
        'number_of_passengers' => 'integer',
    ];

    /**
     * Get the user that owns the ferry ticket.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the schedule associated with the ticket.
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(FerrySchedule::class, 'schedule_id');
    }

    /**
     * Get the booking associated with the ticket.
     */
    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
