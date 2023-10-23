<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\EventController;
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

Route::get('/index.html', function () {
    return view('index');
})->name('home');

Route::post('/index.html', [OrganizerController::class, 'login']);

Route::get('/channels/create.html', function () {
    return view('channels.create');
});

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

Route::get('/rooms/create.html', function () {
    return view('rooms.create');
});

Route::get('/sessions/create.html', function () {
    return view('sessions.create');
});

Route::get('/sessions/edit.html', function () {
    return view('sessions.edit');
});

Route::get('/tickets/create.html', function () {
    return view('tickets.create');
});
