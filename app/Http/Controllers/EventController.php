<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\MessageBag;

class EventController extends Controller
{

    public function index() {
        //lấy $name và ds sự kiện

        $id = Session::get('id');

        $organizer = Organizer::query()->where('id', $id)->first();
        $name = $organizer->name;

        $events = Event::query()->where('organizer_id', $id)->get();

        return view('events.index', ['name' => $name, 'events' => $events]);
    }

//    public function index_create() {
//        $id = Session::get('id');
//
//        $organizer = Organizer::query()->where('id', $id)->first();
//        $name = $organizer->name;
//
//        return view('events.create', ['name' => $name]);
//
//    }

    public function create() {
        $errors = new MessageBag();

        $slug = request()->input('slug');
        $existingSlug = Event::where('slug', $slug)->exists();

        if ($existingSlug) {
            $errors->add('slug-existing', 'Slug đã được sử dụng');
            return redirect()->back()->withErrors($errors)->withInput();
        } else if(!empty($slug) && !preg_match("/^[a-z0-9\-]+$/", $slug)) {
            $errors->add('slug-invalid', "Slug không được để trống và chỉ chứa các ký tự a-z, 0-9 và '-'");
            return redirect()->back()->withErrors($errors)->withInput();
        }

        $id = Session::get('id');
        $name = \request()->input('name');
        $slug = \request()->input('slug');
        $date = \request()->input('date');

        Event::query()->create([
            'organizer_id' => $id,
            'name' => $name,
            'slug' => $slug,
            'date' => $date
        ]);

        return redirect()->route('events.detail', ['slug' => $slug])->with('success', "✓ Tạo sự kiện thành công!");
    }

    public function index_detail($slug) {
        $events = Event::query()->where('slug', $slug)->first();
        $nameEvent = $events->name;
        $dateEvent = $events->date;

        return view('events.detail', ['name' => $nameEvent, 'date' => $dateEvent, 'slug' => $slug]);
    }

    public function index_edit($slug) {
        $events = Event::query()->where('slug', $slug)->first();
        $nameEvent = $events->name;
        $slugEvent = $events->slug;
        $dateEvent = $events->date;

        return view('events.edit', ['name' => $nameEvent, 'slug' => $slugEvent, 'date' => $dateEvent]);
    }

    public function edit($slug) {
        $events = Event::query()->where('slug', $slug)->first();

        $events->name = \request()->input('name');
        $events->slug = \request()->input('slug');
        $events->date = \request()->input('date');

        $errors = new MessageBag();

        $existingSlug = Event::where('slug', $events->slug)->exists();

        if ($existingSlug) {
            $errors->add('slug-existing', 'Slug đã được sử dụng');
            return redirect()->back()->withErrors($errors)->withInput();
        } else if(!empty($events->slug) && !preg_match("/^[a-z0-9\-]+$/", $events->slug)) {
            $errors->add('slug-invalid', "Slug không được để trống và chỉ chứa các ký tự a-z, 0-9 và '-'");
            return redirect()->back()->withErrors($errors)->withInput();
        } else {
            $events->save();
            return redirect()->route('events.detail', ['slug' => $events->slug])->with('success', "✓ Cập nhật sự kiện thành công!");
        }
    }
}
