<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTicketController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RoomController;
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
//Auth::routes();

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('index');
})->name('home');

Route::post('/index.html', [OrganizerController::class, 'login']);

Route::get('/channels/create.html/{slug}', [ChannelController::class, 'index']);

Route::post('/channels/create.html/{slug}', [ChannelController::class, 'create']);

Route::get('/events/create.html', function() {
    return view('events.create');
});

Route::post('/events/create.html', [EventController::class, 'create']);

Route::get('/events/detail.html/{slug}', [EventController::class, 'index_detail'])->name('events.detail');

Route::get('/events/edit.html/{slug}', [EventController::class, 'index_edit']);

Route::post('/events/edit.html/{slug}', [EventController::class, 'edit']);

Route::get('/events/index.html', [EventController::class, 'index'])->name('events');

Route::post('/events/index.html', [OrganizerController::class, 'login']);

Route::get('/reports/index.html', function () {
    return view('reports.index');
});

Route::get('/rooms/create.html/{slug}', [RoomController::class, 'index']);

Route::post('/rooms/create.html/{slug}', [RoomController::class, 'create']);

Route::get('/sessions/create.html/{slug}', [SessionsController::class, 'index']);

Route::post('/sessions/create.html/{slug}', [SessionsController::class, 'create']);

Route::get('/sessions/edit.html', function () {
    return view('sessions.edit');
});

Route::get('/tickets/create.html/{slug}', [EventTicketController::class, 'index']);
Route::post('/tickets/create.html/{slug}', [EventTicketController::class, 'create']);
