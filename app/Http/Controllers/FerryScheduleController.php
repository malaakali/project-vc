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
        $schedules = FerrySchedule::with('ferry')->orderBy('departure_time')->get();
        
        return view('ferry-schedules.index', compact('schedules'));
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
            'ferry_id' => 'required|exists:ferries,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
        ]);

        FerrySchedule::create($request->all());

        return redirect()->route('ferry-schedules.index')->with('status', 'schedule-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(FerrySchedule $ferrySchedule): View
    {
        return view('ferry-schedules.show', compact('ferrySchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FerrySchedule $ferrySchedule): View
    {
        return view('ferry-schedules.edit', compact('ferrySchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FerrySchedule $ferrySchedule): RedirectResponse
    {
        $request->validate([
            'ferry_id' => 'required|exists:ferries,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
            'price' => 'required|numeric|min:0',
        ]);

        $ferrySchedule->update($request->all());

        return redirect()->route('ferry-schedules.index')->with('status', 'schedule-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FerrySchedule $ferrySchedule): RedirectResponse
    {
        $ferrySchedule->delete();

        return redirect()->route('ferry-schedules.index')->with('status', 'schedule-deleted');
    }
}