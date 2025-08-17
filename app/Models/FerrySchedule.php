<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class FerrySchedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ferry_name',
        'departure_time',
        'arrival_time',
        'capacity',
        'price_per_ticket',
        'is_active',
        'is_recurring',
        'recurrence_type',
        'recurrence_interval',
        'recurrence_end_date',
        'days_of_week',
        'parent_schedule_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'price_per_ticket' => 'decimal:2',
        'is_active' => 'boolean',
        'is_recurring' => 'boolean',
        'recurrence_end_date' => 'date',
        'days_of_week' => 'array',
    ];

    /**
     * Get the ferry tickets for this schedule.
     */
    public function ferryTickets(): HasMany
    {
        return $this->hasMany(FerryTicket::class, 'schedule_id');
    }

    /**
     * Get the parent schedule for recurring schedules.
     */
    public function parentSchedule(): BelongsTo
    {
        return $this->belongsTo(FerrySchedule::class, 'parent_schedule_id');
    }

    /**
     * Get the child schedules for recurring schedules.
     */
    public function childSchedules(): HasMany
    {
        return $this->hasMany(FerrySchedule::class, 'parent_schedule_id');
    }

    /**
     * Generate recurring schedules based on the recurrence settings.
     */
    public function generateRecurringSchedules(): void
    {
        if (!$this->is_recurring || !$this->recurrence_type) {
            return;
        }

        $startDate = $this->departure_time->copy();
        $endDate = $this->recurrence_end_date ?
            \Carbon\Carbon::parse($this->recurrence_end_date) :
            $startDate->copy()->addMonths(3);

        $currentDate = $startDate->copy();
        $count = 0;
        $maxOccurrences = 100; // Safety limit

        while ($currentDate->lte($endDate) && $count < $maxOccurrences) {
            // Calculate next occurrence based on recurrence type
            switch ($this->recurrence_type) {
                case 'daily':
                    $currentDate->addDays($this->recurrence_interval);
                    break;
                case 'weekly':
                    $currentDate->addWeeks($this->recurrence_interval);
                    break;
                case 'monthly':
                    $currentDate->addMonths($this->recurrence_interval);
                    break;
                default:
                    return;
            }

            // Skip if we've exceeded the end date
            if ($currentDate->gt($endDate)) {
                break;
            }

            // Skip if specific days of week are set and current day doesn't match
            if (!empty($this->days_of_week)) {
                $dayOfWeek = $currentDate->dayOfWeek;
                if (!in_array($dayOfWeek, $this->days_of_week)) {
                    continue;
                }
            }

            // Calculate arrival time with same interval
            $arrivalTime = $this->arrival_time->copy()->addDays($currentDate->diffInDays($startDate));

            // Create the recurring schedule
            FerrySchedule::create([
                'ferry_name' => $this->ferry_name,
                'departure_time' => $currentDate->toDateTimeString(),
                'arrival_time' => $arrivalTime->toDateTimeString(),
                'capacity' => $this->capacity,
                'price_per_ticket' => $this->price_per_ticket,
                'is_active' => $this->is_active,
                'parent_schedule_id' => $this->id,
            ]);

            $count++;
        }
    }

    /**
     * Check if the schedule has available capacity for the given number of passengers.
     */
    public function hasAvailableCapacity(int $numberOfPassengers): bool
    {
        $bookedPassengers = $this->ferryTickets()
            ->where('departure_date', $this->departure_time->toDateString())
            ->where('status', 'active')
            ->sum('number_of_passengers');

        return ($this->capacity - $bookedPassengers) >= $numberOfPassengers;
    }
}
