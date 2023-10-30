<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Organizer;
use App\Models\Room;
use App\Models\Sessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;

class EventTicketController extends Controller
{
    public function index($slug) {

        $events = Event::query()->where('slug', $slug)->first();

        $nameEvent = $events->name;
        $dateEvent = $events->date;

        return view('tickets.create', [
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
        $cost = \request()->input('cost');
        $special_validity = \request()->input('special_validity');
        $amount = \request()->input('amount');
        $valid_until = \request()->input('valid_until');

        if(empty($special_validity)) {
            $special_validity = NULL;
        }elseif ($special_validity === 'amount') {
            $special_validity = '{"type":"amount","amount":"'.$amount.'"}';
        }else {
            $special_validity = '{"type":"date","date":"'.$valid_until.'"}';
        }

        EventTicket::query()->create([
            'event_id' => $event_id,
            'name' => $name,
            'cost' => $cost,
            'special_validity' => $special_validity
        ]);

        return redirect()->route('events.detail', ['slug' => $slug])->with('success', "✓ Vé được tạo thành công!");
    }
}
