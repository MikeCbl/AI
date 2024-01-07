<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Middleware\GenerateSafeSubmitToken;
use App\Http\Middleware\HandleSafeSubmit;
use App\Models\User;
use App\SafeSubmit\SafeSubmit;

class ReservationController extends Controller
{

    public function showReservation($trackId)
    {
        $track = Track::findOrFail($trackId);
        return view('reservation', compact('track'));
    }


    public function createReservation(Request $request)
    {
        // Validate the request data
        $request->validate([
            'track_id' => 'required|exists:tracks,id',
            'reservation_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        // Check if the track is available
        $track = Track::findOrFail($request->input('track_id'));

        if (!$track->is_available) {
            // return response()->json(['message' => 'Track is not available for reservation'], 400);
            Session::flash('error', 'Track is not available for reservation');
            return redirect()->back();
        }

        // Check if there is any overlapping reservation
        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');

        $reservationExists = Reservation::where('track_id', $track->id)
            ->where('reservation_date', $request->input('reservation_date'))
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })
            ->exists();

        // Check if the track is available for reservation
        if (!$track->is_available) {
            Session::flash('error', 'Track is not available for reservation');
            return redirect()->back();
        }

        if ($reservationExists) {
            // return response()->json(['message' => 'Reservation already exists for the given time'], 400);
            Session::flash('error', 'Reservation already exists for the given time');
            return redirect()->back();
        }

        // Create a new reservation
        $reservation = new Reservation();
        $reservation->user_id = auth()->user()->id;
        $reservation->track()->associate($track);
        $reservation->reservation_date = $request->input('reservation_date');
        $reservation->start_time = $startTime;
        $reservation->end_time = $endTime;
        $reservation->price = $reservation->getDiscountedPriceAttribute();
        // Save the reservation to the database
        $reservation->save();


        // Return a response indicating the successful reservation creation
        Session::flash('success', 'Reservation created successfully');
        return redirect()->back();
    }


    // Optionally, you can perform additional actions like sending notifications or updating related models.
    //NOWE
    public function __construct()
    {
        $this->middleware(HandleSafeSubmit::class)->only('store');
    }


    // public function index(Request $request)
    // {
    //     $currentTime = Carbon::now()->format('Y-m-d H:i:s');

    //     $upcomingReservations = Reservation::orderBy('reservation_date')
    //         ->orderBy('start_time')
    //         ->where('reservation_date', '>=', date('Y-m-d'))
    //         ->orWhere(function ($query) use ($currentTime) {
    //             $query->where('reservation_date', '=', date('Y-m-d'))
    //                 ->where('end_time', '>', $currentTime);
    //         })
    //         ->get();

    //     $pastReservations = Reservation::orderBy('reservation_date', 'desc')
    //         ->orderBy('start_time', 'desc')
    //         ->where('reservation_date', '<', date('Y-m-d'))
    //         ->orWhere(function ($query) use ($currentTime) {
    //             $query->where('reservation_date', '=', date('Y-m-d'))
    //                 ->where('end_time', '<=', $currentTime);
    //         })
    //         ->get();

    //     return view('crud.reservations.list', compact('upcomingReservations', 'pastReservations'));
    // }

    public function index(Request $request)
    {
        $query = $request->input('query');

        $reservations = Reservation::with('user', 'track')
        ->whereHas('user', function ($userQuery) use ($query) {
            $userQuery->where('name', 'like', '%' . $query . '%')
                ->orWhere('last_name', 'like', '%' . $query . '%')
                ->orWhere('email', 'like', '%' . $query . '%');
        })
        ->orWhereHas('track', function ($trackQuery) use ($query) {
            $trackQuery->where('name', 'like', '%' . $query . '%');
        })
        ->orderBy('reservation_date', 'asc')
        ->orderBy('start_time', 'asc')
        ->paginate(4);

        if (empty($query)) {
            //BUG: poprawić orderByRaw
            $reservations = Reservation::with('user', 'track')
            ->orderBy('reservation_date', 'desc')
            ->orderBy('start_time', 'asc')
            ->paginate(4);
        }

        $currentTime = Carbon::now()->format('Y-m-d H:i:s');
        $today = Carbon::now();

        // $upcomingReservations = Reservation::orderBy('reservation_date')
        //     ->orderBy('start_time')
        //     ->where('reservation_date', '>=', date('Y-m-d'))
        //     ->orWhere(function ($query) use ($currentTime) {
        //         $query->where('reservation_date', '=', date('Y-m-d'))
        //             ->where('end_time', '>', $currentTime);
        //     })
        //     ->get();

        // $pastReservations = Reservation::orderBy('reservation_date', 'desc')
        //     ->orderBy('start_time', 'desc')
        //     ->where('reservation_date', '<', date('Y-m-d'))
        //     ->orWhere(function ($query) use ($currentTime) {
        //         $query->where('reservation_date', '=', date('Y-m-d'))
        //             ->where('end_time', '<=', $currentTime);
        //     })
        //     ->get();

        return view('crud.reservations.list', compact('reservations', 'query', 'today')); // 'upcomingReservations', 'pastReservations',
    }


    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        $users = User::all();
        $tracks = Track::all();

        return view('crud.reservations.edit', compact('reservation', 'users', 'tracks'));
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'track_id' => 'required|exists:tracks,id',
            'reservation_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

            // Check if the track is available for reservation
        $track = Track::findOrFail($validatedData['track_id']);
        if (!$track->is_available) {
            Session::flash('error', 'Track is not available for reservation');
            return redirect()->back();
        }

        $startTime = $request->input('start_time');
        $endTime = $request->input('end_time');

        $reservationExists = Reservation::where('track_id', $track->id)
            ->where('reservation_date', $request->input('reservation_date'))
            ->where('id', '!=', $id) // Exclude the current reservation being updated
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })
            ->exists();

        if ($reservationExists) {
            Session::flash('error', 'Reservation already exists for the given time');
            return redirect()->back();
        }
        // dd($validatedData);

        $reservation->fill($validatedData);
        $reservation->save();


        Session::flash('success', 'Reservation updated successfully.');

        return redirect()->back();
    }

    public function store(Request $request, SafeSubmit $safeSubmit)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'track_id' => 'required|exists:tracks,id',
            'reservation_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);
        // dd($validatedData);

        $reservation = new Reservation();
        $reservation->fill($validatedData);
        $reservation->price = $reservation->getDiscountedPriceAttribute();

        $reservation->save();

        \Log::info("created reservation");

        return $safeSubmit->intended(route('reservations.list'));
    }

    public function create()
    {
        $users = User::all();
        $tracks = Track::all();
        return view('crud.reservations.create', compact('users', 'tracks'));
    }

    public function destroy($id, SafeSubmit $safeSubmit)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return $safeSubmit->intended(route('reservations.list'));
        // return redirect()->route('reservations.list')->with('success', 'Reservation deleted successfully.');
    }

}
