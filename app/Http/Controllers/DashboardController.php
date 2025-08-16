<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\FerryTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get active bookings count
        $activeBookingsCount = Booking::where('user_id', $user->id)
            ->where('status', 'confirmed')
            ->where('check_in_date', '>=', now())
            ->count();

        // Get upcoming ferry trips
        $upcomingTripsCount = FerryTicket::where('user_id', $user->id)
            ->where('status', 'active')
            ->where('departure_date', '>=', now())
            ->count();

        // Get total spent this year
        $totalSpent = Booking::where('user_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        // Add ferry ticket spending
        $ferrySpent = FerryTicket::where('user_id', $user->id)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');

        $totalSpent += $ferrySpent;
        $totalSpent = $totalSpent * -1;

        // Calculate loyalty points (simplified calculation)
        $loyaltyPoints = $totalSpent * 0.1; // 1 point per $10 spent

        // Get recent bookings and ferry tickets for activity feed
        $recentBookings = Booking::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentFerryTickets = FerryTicket::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Combine and sort recent activities
        $recentActivities = collect();

        foreach ($recentBookings as $booking) {
            $recentActivities->push([
                'type' => 'booking',
                'title' => 'Room booking ' . ucfirst($booking->status),
                'description' => 'Room #' . ($booking->room_id ?? 'N/A') . ' - Check-in ' . $booking->check_in_date->format('M j'),
                'date' => $booking->created_at,
                'created_at' => $booking->created_at,
            ]);
        }

        foreach ($recentFerryTickets as $ticket) {
            $recentActivities->push([
                'type' => 'ferry',
                'title' => 'Ferry ticket ' . ucfirst($ticket->status),
                'description' => 'Departure ' . $ticket->departure_date->format('M j'),
                'date' => $ticket->created_at,
                'created_at' => $ticket->created_at,
            ]);
        }

        // Sort by date and take the most recent 5
        $recentActivities = $recentActivities
            ->sortByDesc('created_at')
            ->take(5);

        // Get member since date
        $memberSince = $user->created_at->format('M Y');

        // Get total bookings count
        $totalBookings = Booking::where('user_id', $user->id)->count();

        // Get completed trips (simplified as past check-ins)
        $completedTrips = Booking::where('user_id', $user->id)
            ->where('check_out_date', '<', now())
            ->where('status', 'confirmed')
            ->count();

        // Add completed ferry trips
        $completedFerryTrips = FerryTicket::where('user_id', $user->id)
            ->where('departure_date', '<', now())
            ->where('status', 'active')
            ->count();

        $completedTrips += $completedFerryTrips;

        // Determine member level based on completed trips or spending
        $memberLevel = 'Bronze';
        if ($completedTrips >= 10 || $totalSpent >= 2000) {
            $memberLevel = 'Gold';
        } elseif ($completedTrips >= 5 || $totalSpent >= 1000) {
            $memberLevel = 'Silver';
        }

        return view('dashboard', compact(
            'activeBookingsCount',
            'upcomingTripsCount',
            'totalSpent',
            'loyaltyPoints',
            'recentActivities',
            'memberSince',
            'totalBookings',
            'completedTrips',
            'memberLevel'
        ));
    }
}
