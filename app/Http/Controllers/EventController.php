<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Event::query();
        
        // Filter by event type if provided
        if ($request->filled('event_type')) {
            $query->where('event_type', $request->event_type);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->where('start_datetime', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->where('end_datetime', '<=', $request->end_date);
        }
        
        // Default to future events
        if (!$request->filled(['start_date', 'end_date'])) {
            $query->where('start_datetime', '>=', now());
        }
        
        $events = $query->orderBy('start_datetime')->get();
        
        // Get unique event types for filter dropdown
        $eventTypes = Event::distinct()->pluck('event_type');
        
        return view('events.index', compact('events', 'eventTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'start_datetime' => 'required|date|after:today',
            'end_datetime' => 'required|date|after:start_datetime',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Event::create($request->all());

        return redirect()->route('events.index')->with('status', 'event-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event): View
    {
        $event->load(['eventTickets']);
        
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_type' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'start_datetime' => 'required|date|after:today',
            'end_datetime' => 'required|date|after:start_datetime',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')->with('status', 'event-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('events.index')->with('status', 'event-deleted');
    }
}