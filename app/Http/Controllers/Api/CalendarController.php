<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;


class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $reservations = Reservation::all();


        $reservations = Reservation::with('track', 'user')->get();

        $formattedReservations = [];

        foreach ($reservations as $reservation) {
            $formattedReservation = [
                'id' => $reservation->id,
                'user_id' => $reservation->user_id,
                'track_id' => $reservation->track_id,
                'reservation_date' => $reservation->reservation_date,
                'start_time' => $reservation->start_time,
                'end_time' => $reservation->end_time,
                'track_name' => $reservation->track->name,
                'price' => $reservation->price,
                'name' => $reservation->user->name,
                'last_name' => $reservation->user->last_name,
            ];

            $formattedReservations[] = $formattedReservation;
        }



        return response()->json($formattedReservations);
    }
    public function ShowReservations(Request $request)
    {



        return view('reservation');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservation = Reservation::find($id);

        if ($reservation) {
            return response()->json($reservation);
        } else {
            return response()->json(['error' => 'Rezerwacja nie została znaleziona.'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
