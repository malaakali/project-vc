<?php

namespace App\Http\Controllers;

use App\Models\EventTicket;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EventTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $eventTickets = EventTicket::where('user_id', auth()->id())
            ->with(['event'])
            ->orderBy('visit_date', 'desc')
            ->get();
        
        return view('event-tickets.index', compact('eventTickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $eventId = $request->query('event_id');
        $event = $eventId ? Event::findOrFail($eventId) : null;
        
        // Get upcoming events
        $events = Event::where('start_datetime', '>=', now())
            ->orderBy('start_datetime')
            ->get();
        
        return view('event-tickets.create', compact('eventId', 'event', 'events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'visit_date' => 'required|date|after:today',
            'quantity' => 'required|integer|min:1|max:10',
        ]);
        
        // Verify that the event exists
        $event = Event::findOrFail($request->event_id);
        
        // Check if event has available capacity
        $currentParticipants = $event->eventTickets()
            ->where('visit_date', $request->visit_date)
            ->where('status', 'active')
            ->sum('quantity');
            
        if ($event->max_participants && ($currentParticipants + $request->quantity) > $event->max_participants) {
            return back()->withInput()->withErrors(['quantity' => 'Not enough capacity available for this event on the selected date.']);
        }
        
        // Calculate total price
        $totalPrice = $event->price * $request->quantity;
        
        // Create the event ticket
        $eventTicket = EventTicket::create([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
            'purchase_date' => now(),
            'visit_date' => $request->visit_date,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'active',
            'confirmation_code' => 'ET-' . strtoupper(uniqid()),
        ]);

        return redirect()->route('event-tickets.index')->with('status', 'ticket-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventTicket $eventTicket): View
    {
        $this->authorize('view', $eventTicket);
        
        $eventTicket->load(['event']);
        
        return view('event-tickets.show', compact('eventTicket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventTicket $eventTicket): View
    {
        $this->authorize('update', $eventTicket);
        
        $eventTicket->load(['event']);
        
        return view('event-tickets.edit', compact('eventTicket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventTicket $eventTicket): RedirectResponse
    {
        $this->authorize('update', $eventTicket);
        
        $request->validate([
            'visit_date' => 'required|date|after:today',
            'quantity' => 'required|integer|min:1|max:10',
        ]);
        
        // Calculate total price
        $totalPrice = $eventTicket->event->price * $request->quantity;
        
        $eventTicket->update([
            'visit_date' => $request->visit_date,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('event-tickets.index')->with('status', 'ticket-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventTicket $eventTicket): RedirectResponse
    {
        $this->authorize('delete', $eventTicket);
        
        $eventTicket->delete();

        return redirect()->route('event-tickets.index')->with('status', 'ticket-deleted');
    }
}