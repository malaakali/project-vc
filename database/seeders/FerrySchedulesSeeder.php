<?php

namespace Database\Seeders;

use App\Models\FerrySchedule;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FerrySchedulesSeeder extends Seeder
{
    public function run(): void
    {
        $schedules = [
            [
                'departure_time' => Carbon::today()->addHours(8),
                'arrival_time' => Carbon::today()->addHours(10),
                'capacity' => 100,
                'price_per_ticket' => 25.00,
                'is_active' => true,
            ],
            [
                'departure_time' => Carbon::today()->addHours(12),
                'arrival_time' => Carbon::today()->addHours(14),
                'capacity' => 100,
                'price_per_ticket' => 25.00,
                'is_active' => true,
            ],
            [
                'departure_time' => Carbon::today()->addHours(16),
                'arrival_time' => Carbon::today()->addHours(18),
                'capacity' => 100,
                'price_per_ticket' => 25.00,
                'is_active' => true,
            ],
            [
                'departure_time' => Carbon::tomorrow()->addHours(8),
                'arrival_time' => Carbon::tomorrow()->addHours(10),
                'capacity' => 100,
                'price_per_ticket' => 25.00,
                'is_active' => true,
            ],
            [
                'departure_time' => Carbon::tomorrow()->addHours(12),
                'arrival_time' => Carbon::tomorrow()->addHours(14),
                'capacity' => 100,
                'price_per_ticket' => 25.00,
                'is_active' => true,
            ],
            [
                'departure_time' => Carbon::tomorrow()->addHours(16),
                'arrival_time' => Carbon::tomorrow()->addHours(18),
                'capacity' => 100,
                'price_per_ticket' => 25.00,
                'is_active' => true,
            ],
            [
                'departure_time' => Carbon::today()->addDays(2)->addHours(8),
                'arrival_time' => Carbon::today()->addDays(2)->addHours(10),
                'capacity' => 150,
                'price_per_ticket' => 30.00,
                'is_active' => true,
            ],
            [
                'departure_time' => Carbon::today()->addDays(2)->addHours(14),
                'arrival_time' => Carbon::today()->addDays(2)->addHours(16),
                'capacity' => 150,
                'price_per_ticket' => 30.00,
                'is_active' => true,
            ],
        ];

        foreach ($schedules as $schedule) {
            FerrySchedule::create($schedule);
        }
    }
}