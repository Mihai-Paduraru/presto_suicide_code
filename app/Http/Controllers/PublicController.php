<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    public function __construct (){
        $this->middleware('auth')->except('homepage', 'locale');
    }
    public function homepage() {
        $ads = Ad::where('is_accepted', true)->orderBy('created_at', 'DESC')->take(5)->get();
        return view('welcome', compact('ads'));
    }
    public function workWithUs(){
        return view('profile.workWithUs');
    }
    public function sendMail($user_info){
        $user_contact = User::where('id', $user_info)->first();
        $user_contact->request_revisor = true;
        $user_contact->save();
        Mail::to('admin@presto.it')->send(new ContactMail($user_contact));
        return redirect(route('homepage'))->with('flash', 'La tua richiesta è stata inoltrata');
    }

    public function locale($locale){
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
