<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Room;
use App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class SessionsController extends Controller
{
    public function index($slug) {
        $events = Event::query()->where('slug', $slug)->first();

        $idEvent = $events->id;
        $nameEvent = $events->name;
        $dateEvent = $events->date;

        $channels = Channel::query()->where('event_id', $idEvent)->get();

        $rooms = Room::query()->whereIn('channel_id', $channels->pluck('id'))->get();


        return view('sessions.create', [
            'name' => $nameEvent,
            'date' => $dateEvent,
            'slug' => $slug,
            'rooms' => $rooms,
            'channels' => $channels
        ]);
    }

    public function create($slug) {
//        $errors = new MessageBag();
//
//        $events = Event::query()->where('slug', $slug)->first();
//
////        $event_id = $events->id;

        $room_id = \request()->input('room');
        $title = \request()->input('title');
        $description = \request()->input('description');
        $speaker = \request()->input('speaker');
        $start = \request()->input('start');
        $end = \request()->input('end');
        $type = \request()->input('type');
        $cost = \request()->input('cost');


        Sessions::query()->create([
            'room_id' => $room_id,
            'title' => $title,
            'description' => $description,
            'speaker' => $speaker,
            'start' => $start,
            'end' => $end,
            'type' => $type,
            'cost' => $cost,
        ]);

        return redirect()->route('events.detail', ['slug' => $slug])->with('success', "✓ Phiên được tạo thành công!");
    }
}
