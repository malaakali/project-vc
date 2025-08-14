<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $bookings = Booking::where('user_id', auth()->id())->get();
        
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ferry_id' => 'required|exists:ferries,id',
            'date' => 'required|date|after:today',
            'passengers' => 'required|integer|min:1|max:10',
        ]);

        Booking::create([
            'user_id' => auth()->id(),
            'ferry_id' => $request->ferry_id,
            'date' => $request->date,
            'passengers' => $request->passengers,
            'status' => 'confirmed',
        ]);

        return redirect()->route('bookings.index')->with('status', 'booking-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking): View
    {
        $this->authorize('view', $booking);
        
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking): View
    {
        $this->authorize('update', $booking);
        
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking): RedirectResponse
    {
        $this->authorize('update', $booking);
        
        $request->validate([
            'date' => 'required|date|after:today',
            'passengers' => 'required|integer|min:1|max:10',
        ]);

        $booking->update($request->only(['date', 'passengers']));

        return redirect()->route('bookings.index')->with('status', 'booking-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking): RedirectResponse
    {
        $this->authorize('delete', $booking);
        
        $booking->delete();

        return redirect()->route('bookings.index')->with('status', 'booking-deleted');
    }
}