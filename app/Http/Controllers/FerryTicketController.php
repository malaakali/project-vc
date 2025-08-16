<?php

namespace App\Http\Controllers;

use App\Models\FerryTicket;
use App\Models\FerrySchedule;
use App\Models\Booking;
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
        $ferryTickets = FerryTicket::where('user_id', auth()->id())
            ->with(['schedule', 'booking'])
            ->orderBy('departure_date', 'desc')
            ->get();
        
        return view('ferry.index', compact('ferryTickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $scheduleId = $request->query('schedule_id');
        $selectedSchedule = $scheduleId ? FerrySchedule::find($scheduleId) : null;
        
        // Get active schedules for the next 30 days
        $schedules = FerrySchedule::where('departure_time', '>', now())
            ->where('departure_time', '<', now()->addDays(30))
            ->where('is_active', true)
            ->orderBy('departure_time')
            ->get();
            
        // Get user's confirmed bookings for the next 30 days
        $bookings = Booking::where('user_id', auth()->id())
            ->where('status', 'confirmed')
            ->where('check_in_date', '>', now())
            ->where('check_in_date', '<', now()->addDays(30))
            ->with(['room'])
            ->get();
        
        return view('ferry.create', compact('scheduleId', 'selectedSchedule', 'schedules', 'bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'schedule_id' => 'required|exists:ferry_schedules,id',
            'booking_id' => 'required|exists:bookings,id',
            'number_of_passengers' => 'required|integer|min:1|max:10',
            'departure_date' => 'required|date|after:today',
        ]);
        
        // Verify that the booking belongs to the authenticated user
        $booking = Booking::where('id', $request->booking_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
            
        // Verify that the schedule exists and is active
        $schedule = FerrySchedule::where('id', $request->schedule_id)
            ->where('is_active', true)
            ->where('departure_time', '>', now())
            ->firstOrFail();
            
        // Calculate total price
        $totalPrice = $schedule->price_per_ticket * $request->number_of_passengers;
        
        // Create the ferry ticket
        $ferryTicket = FerryTicket::create([
            'user_id' => auth()->id(),
            'schedule_id' => $request->schedule_id,
            'booking_id' => $request->booking_id,
            'purchase_date' => now(),
            'departure_date' => $request->departure_date,
            'number_of_passengers' => $request->number_of_passengers,
            'total_price' => $totalPrice,
            'status' => 'active',
            'confirmation_code' => 'FT-' . strtoupper(uniqid()),
        ]);

        return redirect()->route('ferry.index')->with('status', 'ticket-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(FerryTicket $ferryTicket): View
    {
        $this->authorize('view', $ferryTicket);
        
        $ferryTicket->load(['schedule', 'booking.room']);
        
        return view('ferry.show', compact('ferryTicket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FerryTicket $ferryTicket): View
    {
        $this->authorize('update', $ferryTicket);
        
        $ferryTicket->load(['schedule', 'booking.room']);
        
        // Get active schedules for the next 30 days
        $schedules = FerrySchedule::where('departure_time', '>', now())
            ->where('departure_time', '<', now()->addDays(30))
            ->where('is_active', true)
            ->orderBy('departure_time')
            ->get();
            
        return view('ferry.edit', compact('ferryTicket', 'schedules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FerryTicket $ferryTicket): RedirectResponse
    {
        $this->authorize('update', $ferryTicket);
        
        $request->validate([
            'schedule_id' => 'required|exists:ferry_schedules,id',
            'number_of_passengers' => 'required|integer|min:1|max:10',
        ]);
        
        // Verify that the schedule exists and is active
        $schedule = FerrySchedule::where('id', $request->schedule_id)
            ->where('is_active', true)
            ->where('departure_time', '>', now())
            ->firstOrFail();
            
        // Calculate total price
        $totalPrice = $schedule->price_per_ticket * $request->number_of_passengers;
        
        $ferryTicket->update([
            'schedule_id' => $request->schedule_id,
            'number_of_passengers' => $request->number_of_passengers,
            'total_price' => $totalPrice,
        ]);

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