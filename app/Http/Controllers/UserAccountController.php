<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;



class UserAccountController extends Controller
{


    public function create()
    {
        return view('User.CreateAccount');
    }

    public function store(Request $request)
    {
        // $user = User::create($request->validate([
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:8|confirmed'
        // ]));
        // // $user->save();
        // Auth::login($user);
        // event(new Registered($user));

        $validatedData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'birth_date' => 'required|date',
            'birth_place' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:9',
            'residential_address' => 'required',
            'pesel' => 'required|digits:11|unique:users',
            'admission_date' => 'date',
            'image' => 'nullable|image|mimes:jpeg,jpg,webp,png|max:4096', //  kilobytes (4MB = 4 * 1024)
            'password' => 'required|min:8|confirmed'
        ]);

        // if ($request->hasFile('image')) {

        //     $image = $request->file('image');

        //     $imageName = Str::random(20) . '.' . $image->getClientOriginalExtension();
        //     $imagePath = $image->storeAs('img/user/', $imageName, 'public');
        //     $validatedData['image'] = $imagePath;
        // }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.webp'; // Include the file extension as .webp

            $imagePath = 'img/user/' . $imageName; // Update the image path

            $image = Image::make($image)->encode('webp', 50)->resize(400, 400);

            // $image->save(public_path($imagePath)); // Sproblem z uprawnieniami
            $image->save(storage_path('app/public/' . $imagePath));

            $validatedData['image'] = $imagePath;
        } else {
            // Assign default profile picture based on gender
            if ($validatedData['gender'] === 'M') {
                $validatedData['image'] = 'img/user/default/male.jpg';
            } else {
                $validatedData['image'] = 'img/user/default/female.jpg';
            }
        }

        $user = User::create($validatedData);
        Auth::login($user);

        return redirect()->route('user')
            ->with('success', 'Account created!');
    }
}
