<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Middleware\GenerateSafeSubmitToken;
use App\Http\Middleware\HandleSafeSubmit;
use App\SafeSubmit\SafeSubmit;

class TrackController extends Controller
{
    public function __construct()
    {
        $this->middleware(HandleSafeSubmit::class)->only('store');
    }

    //
    public function legacyIndex()
    {
        $tracks = DB::table('tracks')->get();

        return view('track', compact('tracks'));
    }

    public function index(Request $request)
    {
        $tracks = Track::all();

        return view('crud.tracks.list', compact('tracks'));
    }

    public function edit($id)
    {
        $track = Track::findOrFail($id);

        return view('crud.tracks.edit', compact('track'));
    }

    public function update(Request $request, $id)
    {
        $track = Track::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_hour' => 'required|numeric|min:1',
            'image' => 'image|mimes:jpeg,png,jpg|max:4096',
            // Add validation rules for other fields
        ], [
            'image.max' => 'The image file size should be up to 4MB.',
            'image.mimes' => 'Images have to be of type: jpeg, png, jpg.'
        ]);

        if ($request->hasFile('image')) {
            if (!Str::startsWith($track->img, 'img/track/default/')) {
                Storage::disk('public')->delete($track->img);
            }

            $image = $request->file('image');
            $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('img/track/', $imageName, 'public');
            $validatedData['img'] = $imagePath;
        }

        $track->is_available = $request->input('is_available', false);
        $track->update($validatedData);

        Session::flash('success', 'Track updated successfully.');

        return redirect()->back();
    }

    public function store(Request $request, SafeSubmit $safeSubmit)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'img' => 'required',
            'price_per_hour' => 'required|numeric|min:1',
            'description' => 'required|string',
            'is_available' => 'boolean',
        ]);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('img/track/', $imageName, 'public');
            $validatedData['img'] = $imagePath;

        }

        Track::create($validatedData);

        \Log::info("created track");
        Session::flashInput($request->all()); // Preserve the form input values

        return $safeSubmit->intended(route('tracks.list'))->withInput();
        // return redirect()->route('tracks.list')->with('success', 'Track created successfully.');
    }

    public function create()
    {
        return view('crud.tracks.add');
    }

    public function destroy($id)
    {
        $track = Track::findOrFail($id);

        // Delete the track image if it exists
        if (!Str::startsWith($track->img, 'img/track/default/')) {
            Storage::disk('public')->delete($track->img);
        }

        $track->delete();

        return redirect()->route('tracks.list')->with('success', 'Track deleted successfully.');
    }
}
