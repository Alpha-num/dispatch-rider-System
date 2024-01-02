<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RidesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [ProfileController::class, 'home'] )->name('home');
    Route::get('/bookings', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::patch('/booking/complete', [BookingController::class, 'complete'])->name('booking.complete');
    Route::get('/booking/view/{booking_id}', [BookingController::class, 'view'])->name('booking.view');
    Route::get('/rides', [RidesController::class, 'index'])->name('rides.index');
    Route::get('/ride/{id}/accept', [RidesController::class, 'accept'])->name('ride.accept');
    Route::post('/ride/store', [RidesController::class, 'store'])->name('rides.store');
    Route::get('/ride/{ride_id}/view', [RidesController::class, 'view'])->name('ride.view');
    Route::patch('/ride/complete', [RidesController::class, 'complete'])->name('ride.complete');
    Route::patch('/ride/update', [RidesController::class, 'update'])->name('ride.update');
    Route::get('/rider/{rider_id}/rating', [RatingController::class, 'create'])->name('rating.create');
    Route::put('/rider/rating', [RatingController::class, 'store'])->name('rating.store');
    Route::get('/rating/index', [RatingController::class, 'index'])->name('ratings.index');
});
