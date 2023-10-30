<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Room;
use App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class ChannelController extends Controller
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

        return view('channels.create', [
            'name' => $nameEvent,
            'date' => $dateEvent,
            'slug' => $slug
        ]);
    }

    public function create($slug) {
        $errors = new MessageBag();

        $events = Event::query()->where('slug', $slug)->first();

        $event_id = $events->id;
        $name = \request()->input('name');

        Channel::query()->create([
            'event_id' => $event_id,
            'name' => $name
        ]);

        return redirect()->route('events.detail', ['slug' => $slug])->with('success', "✓ Kênh được tạo thành công!");
    }
}
