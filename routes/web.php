<?php

use Illuminate\Support\Facades\Route;


use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\CalendarController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\CrudController;
use App\Models\Reservation;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
})->name('home');


Route::get('/track', [TrackController::class, 'legacyIndex'])->name('track');


//TODO: crud
// jezeli zmieniasz folder to w controller musisz zmienic sciezke
// view(Crud.crud)
// Route::get('/crud', [CrudController::class, 'searchUser'])->name('crud');



// User Edit with admin privileges
// Route::middleware('admin')->group(function () {

//     //list users
//     Route::get('/users', [CrudController::class, 'searchUser'])->name('users.list');
//     //search user
//     Route::get('/users/search', [CrudController::class, 'searchUser'])->name('users.search');
//     //edit  user
//     Route::get('/users/{id}', [CrudController::class, 'editUser'])->name('users.edit');

//     //update user
//     Route::put('/users/{id}', [CrudController::class, 'updateUser'])->name('users.update');
//     //delete user
//     Route::delete('/users/{id}', [CrudController::class,'deleteUser'])->name('users.delete');;


//     //Crud
//     Route::get('/crud', function () {
//         return view('crud.crud');
//     })->name('crud');


//     //Api Protected routes
//     Route::get('/api/reservations', [CalendarController::class, 'index']);
//     Route::get('/api/reservations/{id}', [CalendarController::class, 'show']);


//         // list track
//         Route::get('/tracks', [CrudController::class, 'searchTrack'])->name('tracks.list');
//         //add
//         Route::get('/tracks/add', [CrudController::class, 'showAddForm'])->name('tracks.add');
//        // Store a new track
//        Route::post('/tracks', [CrudController::class, 'addTrack'])->name('tracks.store');//->middleware('throttle:1,5');
//         // edit
//         Route::get('/tracks/{id}', [CrudController::class, 'editTrack'])->name('tracks.edit');
//         // update
//         Route::put('/tracks/{id}', [CrudController::class, 'updateTrack'])->name('tracks.update');

// });



Route::middleware('admin')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.list');
    Route::get('/users/search', [UserController::class, 'index'])->name('users.search');
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.delete');

    Route::get('/crud', function () {
        return view('crud.crud');
    })->name('crud');

    //Api Protected routes
    Route::get('/api/reservations', [CalendarController::class, 'index']);
    Route::get('/api/reservations/{id}', [CalendarController::class, 'show']);

    //list track
    Route::get('/tracks', [TrackController::class, 'index'])->name('tracks.list');
    //add track
    Route::get('/tracks/add', [TrackController::class, 'create'])->name('tracks.add');
    //store a new track
    Route::post('/tracks', [TrackController::class, 'store'])->name('tracks.store');
    //edit track
    Route::get('/tracks/{id}', [TrackController::class, 'edit'])->name('tracks.edit');
    //update track
    Route::put('/tracks/{id}', [TrackController::class, 'update'])->name('tracks.update');
    //delete track
    Route::delete('/tracks/{id}', [TrackController::class, 'destroy'])->name('tracks.delete');

    //nowe
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.list');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.delete');
});



// Track Edit
// Route::get('/tracks/{id}/edit', [CrudController::class, 'trackEdit'])->name('tracks.TrackEdit');

//user





//tutaj zabezpieczenie w usercontoller czy jest zalogowany
Route::get('/user', [UserController::class, 'showUserProfile'])->name('user');

Route::middleware('auth')->group(function () {
    //calendar only for users
    Route::get('/calendar', function(){
        return view('calendar');
    })->name('calendar');

    //reservation
    Route::get('/reservation/{track}', [ReservationController::class, 'showReservation'])->name('reservation');
    //create reservation
    Route::post('/reservation', [ReservationController::class, 'createReservation'])->name('reservation.store');


    Route::middleware('can:update-profile,id')->group(function () {
        Route::get('/users/{id}/edit-profile', [UserController::class, 'editProfile'])
            ->name('users.editProfile');

        Route::put('/users/{id}/update-profile', [UserController::class, 'updateProfile'])
            ->name('users.updateProfile');
    });

});





Route::get('/contact', [UserController::class, 'showContactPage'])->name('contact');


// // Login/Logout
Route::get('login',[AuthController::class,'create'])->name('login');

Route::post('login',[AuthController::class,'store'])->name('login.store');

Route::get('logout',[AuthController::class,'destroy'])->name('logout');


//register
Route::get('/register', [UserAccountController::class, 'create'])->name('register.create');
Route::post('/register', [UserAccountController::class, 'store'])->name('register.store');

