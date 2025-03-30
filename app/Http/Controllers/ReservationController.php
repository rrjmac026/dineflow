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
        $reservations = Reservation::with('user')->latest()->get();
        return view('reservations.index', compact('reservations'));
    }

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'time' => $request->time,
            'guests' => $request->guests
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully');
    }

    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update($request->validated());
        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully');
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')
            ->with('success', 'Reservation cancelled successfully');
    }
}
