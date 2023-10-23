<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;

use App\Models\Organizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizerController extends Controller
{

    public function login() {
        $email = \request()->input('email');
        $password = \request()->input('password');

        $checkEmail = Organizer::query()->where('email', $email)->first();
        $checkPassword = Organizer::query()->where('password_hash', $password)->first();

        if($checkEmail && $checkPassword) {
            $id = $checkEmail->id;
            $name = $checkEmail->name;

            Session::put('id', $id);
            Session::put('name', $name);
            return redirect()->route('events');
//            dd($name);
        } else {
            return redirect()->back()->withErrors(['message' => 'Tên đăng nhập hoặc mật khẩu không chính xác']);
        }
    }
}
