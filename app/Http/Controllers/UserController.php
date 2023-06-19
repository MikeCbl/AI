<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
//dla excela
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function showUserProfile()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return view('user', compact('user'));
        } else {
            return redirect()->route('login');
        }
    }

    public function showContactPage()
    {
        // 1 and 3
        // $users = User::where('role_id', [1, 3])->get();


        // 1 or 3
        $users = User::select('name', 'last_name', 'email', 'phone', 'role_id')
        ->where('role_id', 2)
        ->orWhere('role_id', 1)
        ->get();

        return view('contact', compact('users'));
    }

    public function index(Request $request)
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

        return view('crud.users.list', compact('users', 'query'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all();

        return view('crud.users.edit', compact('user', 'roles'));
    }

    // self  edit profile form
    public function editProfile($id)
    {

        $user = User::findOrFail($id);

        return view('User.editProfile', compact('user'));
    }
    //self update Update user profile
    public function updateProfile(Request $request, $id)
    {


        $validatedData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'birth_date' => 'required|date',
            'birth_place' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|digits:9',
            'residential_address' => 'required',
            'pesel' => 'required|digits:11|unique:users,pesel,' . $id,
            'image' => 'nullable|image|mimes:jpeg,jpg,webp,png|max:4096', //  kilobytes (4MB = 4 * 1024)
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::random(20) . '.webp';
            $imagePath = 'img/user/' . $imageName;

            $image = Image::make($image)->encode('webp', 50)->resize(400, 400);
            $image->save(storage_path('app/public/' . $imagePath));

            $validatedData['image'] = $imagePath;
        }
        // dd($validatedData);
        $user->update($validatedData);

        return redirect()->route('user'); //, $id)->with('success', 'Profile updated successfully.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required',
            'birth_date' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|digits:9',
            'residential_address' => 'required|string|max:255',
            'pesel' => 'required|digits:11|unique:users,pesel,' . $id,
            'role_id' => 'required|integer|exists:roles,role_id'
        ]);

        // dd($validatedData);
        $user->fill($validatedData);
        $user->save();

        return redirect()->route('users.list')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.list')->with('success', 'User deleted successfully.');
    }
}
