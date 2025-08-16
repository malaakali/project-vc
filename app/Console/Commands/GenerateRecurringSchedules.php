<?php

namespace App\Console\Commands;

use App\Models\FerrySchedule;
use Illuminate\Console\Command;

class GenerateRecurringSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ferry:generate-recurring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate recurring ferry schedules';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚢 Generating recurring ferry schedules for the next week...');
        $this->info('📅 Target period: ' . now()->format('Y-m-d') . ' to ' . now()->addWeek()->format('Y-m-d'));
        $this->newLine();

        $recurringSchedules = FerrySchedule::where('is_recurring', true)
            ->whereNull('parent_schedule_id')
            ->get();

        if ($recurringSchedules->isEmpty()) {
            $this->warn('No recurring schedules found.');
            return Command::SUCCESS;
        }

        $totalGenerated = 0;
        $totalSkipped = 0;

        foreach ($recurringSchedules as $schedule) {
            $this->info("🔄 Processing: {$schedule->ferry_name} - {$schedule->recurrence_type} schedule");
            $this->info("   Original: {$schedule->departure_time->format('Y-m-d H:i')}");
            
            $beforeCount = $schedule->childSchedules()->count();
            
            // Generate schedules and track individual creations
            $createdCount = 0;
            $this->generateSchedulesWithTracking($schedule, $createdCount);
            
            $afterCount = $schedule->childSchedules()->count();
            $actualGenerated = $afterCount - $beforeCount;
            
            $totalGenerated += $actualGenerated;
            
            if ($actualGenerated > 0) {
                $this->info("   ✅ Generated {$actualGenerated} new instances");
            } else {
                $this->info("   ⏭️  No new instances needed (all exist)");
                $totalSkipped++;
            }
            $this->newLine();
        }

        $this->info("📊 Summary:");
        $this->info("   🆕 Total new schedules: {$totalGenerated}");
        $this->info("   ⏭️  Schedules with no changes: {$totalSkipped}");
        $this->info("   📅 Schedules now available until: " . now()->addWeek()->format('Y-m-d'));
        
        return Command::SUCCESS;
    }

    private function generateSchedulesWithTracking($schedule, &$createdCount)
    {
        if (!$schedule->is_recurring) {
            return;
        }

        $today = now()->startOfDay();
        $nextWeekSameDay = $today->copy()->addWeek();
        $endDate = $schedule->recurrence_end_date ?? now()->addYear();
        
        // Start from today or the original departure date, whichever is later
        $currentDate = $schedule->departure_time->copy()->startOfDay();
        if ($currentDate->lt($today)) {
            $currentDate = $today->copy();
        }
        
        // Generate schedules until next week same day
        while ($currentDate->lte($nextWeekSameDay) && $currentDate->lte($endDate)) {
            $nextOccurrence = $this->calculateNextOccurrenceForSchedule($schedule, $currentDate);
            
            if ($nextOccurrence && $nextOccurrence->lte($nextWeekSameDay) && $nextOccurrence->lte($endDate)) {
                $wasCreated = $this->createOccurrenceForSchedule($schedule, $nextOccurrence);
                if ($wasCreated) {
                    $createdCount++;
                    $this->info("      + {$nextOccurrence->format('Y-m-d H:i')}");
                }
                $currentDate = $nextOccurrence->copy()->addDay();
            } else {
                break;
            }
        }
    }

    private function calculateNextOccurrenceForSchedule($schedule, $currentDate)
    {
        $originalTime = $schedule->departure_time;
        
        switch ($schedule->recurrence_type) {
            case 'daily':
                // Find the next daily occurrence from current date
                $nextDate = $currentDate->copy()->setTime($originalTime->hour, $originalTime->minute, $originalTime->second);
                if ($nextDate->lte($currentDate)) {
                    $nextDate->addDays($schedule->recurrence_interval);
                }
                return $nextDate;
                
            case 'weekly':
                return $this->calculateWeeklyOccurrenceForSchedule($schedule, $currentDate);
                
            case 'monthly':
                // Find the next monthly occurrence
                $nextDate = $currentDate->copy()->setTime($originalTime->hour, $originalTime->minute, $originalTime->second);
                $nextDate->day($originalTime->day);
                if ($nextDate->lte($currentDate)) {
                    $nextDate->addMonths($schedule->recurrence_interval);
                }
                return $nextDate;
                
            default:
                return null;
        }
    }

    private function calculateWeeklyOccurrenceForSchedule($schedule, $currentDate)
    {
        $originalTime = $schedule->departure_time;
        
        if (!$schedule->days_of_week || empty($schedule->days_of_week)) {
            // Default weekly recurrence - same day of week as original
            $nextDate = $currentDate->copy()->setTime($originalTime->hour, $originalTime->minute, $originalTime->second);
            $nextDate->dayOfWeek($originalTime->dayOfWeek);
            
            if ($nextDate->lte($currentDate)) {
                $nextDate->addWeeks($schedule->recurrence_interval);
            }
            return $nextDate;
        }

        $targetDays = $schedule->days_of_week;
        $searchDate = $currentDate->copy()->addDay();
        
        // Look for the next occurrence within the next 14 days
        for ($i = 0; $i < 14; $i++) {
            if (in_array($searchDate->dayOfWeek, $targetDays)) {
                return $searchDate->copy()->setTime($originalTime->hour, $originalTime->minute, $originalTime->second);
            }
            $searchDate->addDay();
        }
        
        return null;
    }

    private function createOccurrenceForSchedule($schedule, $date)
    {
        $duration = $schedule->arrival_time->diffInMinutes($schedule->departure_time);
        
        // Check if a schedule already exists for this exact departure time and parent
        $existingSchedule = FerrySchedule::where('departure_time', $date)
            ->where('parent_schedule_id', $schedule->id)
            ->first();
            
        // Also check if there's any schedule (including manual ones) at this exact time for this ferry
        $conflictingSchedule = FerrySchedule::where('departure_time', $date)
            ->where('ferry_name', $schedule->ferry_name)
            ->first();
            
        if (!$existingSchedule && !$conflictingSchedule) {
            FerrySchedule::create([
                'departure_time' => $date,
                'arrival_time' => $date->copy()->addMinutes($duration),
                'capacity' => $schedule->capacity,
                'price_per_ticket' => $schedule->price_per_ticket,
                'is_active' => $schedule->is_active,
                'ferry_name' => $schedule->ferry_name,
                'is_recurring' => false,
                'parent_schedule_id' => $schedule->id,
            ]);
            
            return true; // Schedule was created
        }
        
        return false; // Schedule already exists or conflicts
    }
}
