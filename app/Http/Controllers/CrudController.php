<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Track;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\Cache;




class CrudController extends Controller
{


     //crud.blade.php
     public function searchUser(Request $request)
     {
         $query = $request->input('query');


         $users = User::where('name', 'like', '%'.$query.'%')
                 ->orWhere('last_name', 'like', '%'.$query.'%')
                 ->orWhere('email', 'like', '%'.$query.'%')
                 ->orWhere('phone', 'like', '%'.$query.'%')
                 ->orWhere('pesel', 'like', '%'.$query.'%')
                 ->get();

            if (empty($query)) {
                $users = User::all();
            }

        return view('crud.users.list',  compact('users', 'query'));
     }


     public function editUser($id)
     {
        $user = User::findOrFail($id);

         return view('crud.users.edit', compact('user'));
     }

     public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // $user->name = $request->input('name');
        // $user->last_name = $request->input('last_name');
        // $user->birth_place = $request->input('birth_place');
        // Update other fields

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            // Add validation rules for other fields
        ]);

        $user->fill($validatedData);

        $user->save();

        // Redirect or return a response
        return Redirect::to('/users');
    }
    public function deleteUser($id)
    {
        // Retrieve the user by ID
        $user = User::findOrFail($id);

        // Perform any additional checks here before deleting the user,
        // such as checking the user's role or reservation status.

        // Delete the user
        $user->delete();

        // Redirect back or to a specific page
        return Redirect::to('/users')->with('success', 'User deleted successfully.');
    }



    //search
    public function searchTrack(Request $request)
     {
        $tracks = Track::all();

        return view('crud.tracks.list',  compact('tracks'));
     }

    //track
    public function editTrack($id)
    {
        $track = Track::findOrFail($id);
        return view('crud.tracks.edit', compact('track'));

    }



    public function updateTrack(Request $request, $id)
    {
        $track = Track::findOrFail($id);

        // Update track fields based on the request input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg|max:4096', //kilobytes (4MB = 4 * 1024)    2048 kb = 2mb, 5120 kb = 5mb
            // Add validation rules for other fields
        ], [
            'image.max' => 'The image file size should be up to 4MB.', // Custom error message
            'image.mimes' => 'Images have to be of type: jpeg, png, jpg.'
        ]);


        if ($request->hasFile('image')) {

            // Delete the old image file (optional)
            // Storage::disk('public')->delete($track->img);

            // usuniecie zdjecia jezeli nie jest domyslnym
            if (!Str::startsWith($track->img, 'img/track/default/')) {
                Storage::disk('public')->delete($track->img);
            }


            // Store the new image file
            $image = $request->file('image');

            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('img/track/', $imageName, 'public');
            $validatedData['img'] = $imagePath;
        }

        // Toggle the availability based on the checkbox value
        $track->is_available = $request->input('is_available', false);

        $track->update($validatedData);

        // Set success message
        Session::flash('success', 'Track updated successfully.');


        // Redirect or return a response
        // return redirect('/tracks');
        return redirect()->back();
    }



    public function addTrack(Request $request)
    {

        // do sprawdzania czy juz przeslano formularz
        // if ($request->session()->has('track_added')) {
        //     // $request->session()->forget('track_added');
        //     return redirect()->route('tracks.list')->with('info', 'Track already added.');
        // }

        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'img' => 'required',
            'price_per_hour' => 'required|numeric',
            'description' => 'required|string',
            'is_available' => 'boolean',
        ]);

            // Handle image upload
        if ($request->hasFile('img')) {


            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();


            $imagePath = $image->storeAs('img/track/', $imageName, 'public');
            $validatedData['img'] = $imagePath;
        }

        Track::create($validatedData);

        // zapisz przeslano formularz
        // zeby zablokowac ponowne przeslanie tego samego formularza
        // Mark the form as submitted
        // $request->session()->put('track_added', true);

        // Clear the 'track_added' session variable after successful track creation
        // $request->session()->forget('track_added');

        \Log::info("message");
        return redirect()->route('tracks.list');//>with('success', 'Track created successfully.');
    }




    public function showAddForm()
    {
        return view('crud.tracks.add');
    }



    public function deleteTrack($id)
    {
        // Retrieve the track by ID
        $track = Track::findOrFail($id);

        // Perform any additional checks here before deleting the track,
        // such as checking if there are any reservations associated with the track.

        // Delete the track
        $track->delete();

        // Redirect back or to a specific page
        return redirect('/tracks')->with('success', 'Track deleted successfully.');
    }

}
