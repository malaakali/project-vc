<?php

namespace App\Http\Controllers;

use App\Models\FerryTicket;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FerryTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $ferryTickets = FerryTicket::where('user_id', auth()->id())->with('schedule')->get();
        
        return view('ferry.index', compact('ferryTickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $scheduleId = $request->query('schedule_id');
        return view('ferry.create', compact('scheduleId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'schedule_id' => 'required|exists:ferry_schedules,id',
            'passengers' => 'required|integer|min:1|max:10',
        ]);

        FerryTicket::create([
            'user_id' => auth()->id(),
            'schedule_id' => $request->schedule_id,
            'passengers' => $request->passengers,
            'status' => 'confirmed',
        ]);

        return redirect()->route('ferry.index')->with('status', 'ticket-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(FerryTicket $ferryTicket): View
    {
        $this->authorize('view', $ferryTicket);
        
        return view('ferry.show', compact('ferryTicket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FerryTicket $ferryTicket): View
    {
        $this->authorize('update', $ferryTicket);
        
        return view('ferry.edit', compact('ferryTicket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FerryTicket $ferryTicket): RedirectResponse
    {
        $this->authorize('update', $ferryTicket);
        
        $request->validate([
            'passengers' => 'required|integer|min:1|max:10',
        ]);

        $ferryTicket->update($request->only(['passengers']));

        return redirect()->route('ferry.index')->with('status', 'ticket-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FerryTicket $ferryTicket): RedirectResponse
    {
        $this->authorize('delete', $ferryTicket);
        
        $ferryTicket->delete();

        return redirect()->route('ferry.index')->with('status', 'ticket-deleted');
    }
}