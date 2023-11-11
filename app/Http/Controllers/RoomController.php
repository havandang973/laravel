<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Room;
use App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class RoomController extends Controller
{
    public function index($slug) {
        $events = Event::query()->where('slug', $slug)->first();

        $idEvent = $events->id;
        $nameEvent = $events->name;
        $dateEvent = $events->date;

        $events_tickets = EventTicket::query()->where('event_id', $idEvent)->get();

        $channels = Channel::query()->where('event_id', $idEvent)->get();

        $rooms = Room::query()->whereIn('channel_id', $channels->pluck('id'))->get();

        $sessions = Sessions::query()->whereIn('room_id', $rooms->pluck('id'))->get();

        return view('rooms.create', [
            'name' => $nameEvent,
            'date' => $dateEvent,
            'slug' => $slug,
            'channels' => $channels
        ]);
    }

    public function create($slug) {
        $errors = new MessageBag();

//        $events = Event::query()->where('slug', $slug)->first();

        $channel_id = \request()->input('channel');
        $name = \request()->input('name');
        $capacity = \request()->input('capacity');
//        dd($channel_id);
        Room::query()->create([
            'channel_id' => $channel_id,
            'name' => $name,
            'capacity' => $capacity
        ]);

        return redirect()->route('events.detail', ['slug' => $slug])->with('success', "✓ Phòng được tạo thành công!");
    }
}
