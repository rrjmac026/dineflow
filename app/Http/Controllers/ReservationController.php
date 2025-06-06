<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with('user')
            ->latest()
            ->get();
        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        return view('reservations.create');
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'time' => $request->time,
            'guests' => $request->guests,
            'contact_number' => $request->contact_number, 
            'status' => 'pending',
            'special_requests' => $request->special_requests 
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully!');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load('user');
        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', compact('reservation'));
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update([
            'date' => $request->date,
            'time' => $request->time,
            'guests' => $request->guests,
            'special_requests' => $request->special_requests,
            'table_number' => $request->table_number,
            'contact_number' => $request->contact_number
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully!');
    }

    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();
            return redirect()->route('reservations.index')
                ->with('success', 'Reservation cancelled successfully!');
        } catch (\Exception $e) {
            return redirect()->route('reservations.index')
                ->with('error', 'Failed to cancel reservation.');
        }
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,completed,cancelled']
        ]);

        $reservation->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Reservation status updated successfully!');
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
            'guests' => ['required', 'integer', 'min:1']
        ]);

        // Get existing reservations for the requested date and time
        $existingReservations = Reservation::where('date', $request->date)
            ->where('time', $request->time)
            ->where('status', '!=', 'cancelled')
            ->sum('guests');

        // Assuming restaurant capacity is 100
        $isAvailable = ($existingReservations + $request->guests) <= 100;

        return response()->json([
            'available' => $isAvailable,
            'remaining_capacity' => max(0, 100 - $existingReservations)
        ]);
    }
}
