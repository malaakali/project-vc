<?php

namespace App\Http\Controllers;

use App\Models\FerrySchedule;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FerryScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Get active schedules that are in the future
        $schedules = FerrySchedule::whereNull('parent_schedule_id')
            ->where('is_active', true)
            ->where('departure_time', '>', now())
            ->with('childSchedules')
            ->orderBy('departure_time')
            ->get();
        
        // Get active child schedules that are in the future
        $childSchedules = FerrySchedule::whereNotNull('parent_schedule_id')
            ->where('is_active', true)
            ->where('departure_time', '>', now())
            ->orderBy('departure_time')
            ->get();
        
        // Combine and group schedules by date
        $groupedSchedules = $schedules->concat($childSchedules)
            ->groupBy(function ($schedule) {
                return $schedule->departure_time->format('Y-m-d');
            })->sortKeys();
        
        return view('ferry-schedules.index', compact('groupedSchedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('ferry-schedules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ferry_name' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'capacity' => 'required|integer|min:1',
            'price_per_ticket' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'is_recurring' => 'boolean',
            'recurrence_type' => 'nullable|in:daily,weekly,monthly',
            'recurrence_interval' => 'nullable|integer|min:1',
            'recurrence_end_date' => 'nullable|date|after:departure_time',
            'days_of_week' => 'nullable|array',
            'days_of_week.*' => 'integer|between:0,6',
        ]);

        $schedule = FerrySchedule::create($request->all());

        if ($schedule->is_recurring) {
            $schedule->generateRecurringSchedules();
        }

        return redirect()->route('ferry-schedules.index')->with('status', 'schedule-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(FerrySchedule $ferrySchedule): View
    {
        // Only show active schedules
        if (!$ferrySchedule->is_active) {
            abort(404, 'Schedule not found');
        }
        
        return view('ferry-schedules.show', compact('ferrySchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FerrySchedule $ferrySchedule): View
    {
        // Only allow editing of active schedules that haven't departed yet
        if (!$ferrySchedule->is_active || $ferrySchedule->departure_time <= now()) {
            abort(403, 'Cannot edit past or inactive schedules');
        }
        
        // Only allow editing of parent schedules (not auto-generated recurring ones)
        if ($ferrySchedule->parent_schedule_id) {
            abort(403, 'Cannot edit auto-generated recurring schedules directly');
        }
        
        return view('ferry-schedules.edit', compact('ferrySchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FerrySchedule $ferrySchedule): RedirectResponse
    {
        // Only allow updating of active schedules that haven't departed yet
        if (!$ferrySchedule->is_active || $ferrySchedule->departure_time <= now()) {
            abort(403, 'Cannot update past or inactive schedules');
        }
        
        // Only allow updating of parent schedules (not auto-generated recurring ones)
        if ($ferrySchedule->parent_schedule_id) {
            abort(403, 'Cannot update auto-generated recurring schedules directly');
        }
        
        $request->validate([
            'ferry_name' => 'required|string|max:255',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'capacity' => 'required|integer|min:1',
            'price_per_ticket' => 'required|numeric|min:0',
            'is_active' => 'boolean',
            'is_recurring' => 'boolean',
            'recurrence_type' => 'nullable|in:daily,weekly,monthly',
            'recurrence_interval' => 'nullable|integer|min:1',
            'recurrence_end_date' => 'nullable|date|after:departure_time',
            'days_of_week' => 'nullable|array',
            'days_of_week.*' => 'integer|between:0,6',
        ]);

        $ferrySchedule->update($request->all());

        if ($ferrySchedule->is_recurring && $ferrySchedule->wasChanged(['recurrence_type', 'recurrence_interval', 'recurrence_end_date', 'days_of_week'])) {
            $ferrySchedule->childSchedules()->delete();
            $ferrySchedule->generateRecurringSchedules();
        }

        return redirect()->route('ferry-schedules.index')->with('status', 'schedule-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FerrySchedule $ferrySchedule): RedirectResponse
    {
        // Only allow deleting of active schedules that haven't departed yet
        if (!$ferrySchedule->is_active || $ferrySchedule->departure_time <= now()) {
            abort(403, 'Cannot delete past or inactive schedules');
        }
        
        // Only allow deleting of parent schedules (not auto-generated recurring ones)
        if ($ferrySchedule->parent_schedule_id) {
            abort(403, 'Cannot delete auto-generated recurring schedules directly');
        }
        
        $ferrySchedule->delete();

        return redirect()->route('ferry-schedules.index')->with('status', 'schedule-deleted');
    }
}