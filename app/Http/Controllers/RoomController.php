<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Room::where('is_available', true);
        
        // Apply filters if provided
        if ($request->filled('room_type')) {
            $query->where('room_type', $request->room_type);
        }
        
        if ($request->filled('max_occupancy')) {
            $query->where('max_occupancy', '>=', $request->max_occupancy);
        }
        
        $rooms = $query->get();
        
        // Get unique room types for filter dropdown
        $roomTypes = Room::where('is_available', true)
            ->distinct()
            ->pluck('room_type');
        
        return view('rooms.index', compact('rooms', 'roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'max_occupancy' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'required|string',
            'amenities' => 'required|string',
            'is_available' => 'required|boolean',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('status', 'room-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room): View
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room): View
    {
        return view('rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room): RedirectResponse
    {
        $request->validate([
            'room_type' => 'required|string|max:255',
            'max_occupancy' => 'required|integer|min:1',
            'price_per_night' => 'required|numeric|min:0',
            'description' => 'required|string',
            'amenities' => 'required|string',
            'is_available' => 'required|boolean',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('status', 'room-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room): RedirectResponse
    {
        $room->delete();

        return redirect()->route('rooms.index')->with('status', 'room-deleted');
    }
}