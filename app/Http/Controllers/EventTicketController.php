<?php

namespace App\Http\Controllers;

use App\Models\EventTicket;
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
        $eventTickets = EventTicket::where('user_id', auth()->id())->with('event')->get();
        
        return view('event-tickets.index', compact('eventTickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $eventId = $request->query('event_id');
        return view('event-tickets.create', compact('eventId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'quantity' => 'required|integer|min:1',
        ]);

        EventTicket::create([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
            'quantity' => $request->quantity,
            'status' => 'confirmed',
        ]);

        return redirect()->route('event-tickets.index')->with('status', 'ticket-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(EventTicket $eventTicket): View
    {
        $this->authorize('view', $eventTicket);
        
        return view('event-tickets.show', compact('eventTicket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventTicket $eventTicket): View
    {
        $this->authorize('update', $eventTicket);
        
        return view('event-tickets.edit', compact('eventTicket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EventTicket $eventTicket): RedirectResponse
    {
        $this->authorize('update', $eventTicket);
        
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $eventTicket->update($request->only(['quantity']));

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