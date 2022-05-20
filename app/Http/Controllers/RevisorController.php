<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevisorController extends Controller
{
    public function __construct(){
        $this->middleware('auth.revisor');
    }

    public function index(){
        $ad = Ad::where('is_accepted', null)->orderBy('updated_at', 'DESC')->first();
        $lastad = Ad::where('revisor_id', Auth::user()->id)->where('is_accepted', '!=', null)->orderBy('updated_at', 'DESC')->first();
        return view('revisor.index', compact('ad', 'lastad'));
    }

    private function acceptance ($id, $result){
        $ad = Ad::find($id);
        $ad->is_accepted = $result;
        $ad->revisor_id = Auth::user()->id;
        $ad->save();
        return redirect(route('revisor.index'))->with('flash', 'Operazione eseguita');
    }

    public function accept($id){
        return $this->acceptance($id, true);
    }
    public function reject($id){
       return $this->acceptance($id, false);
    }
    public function undo($id){
        return $this->acceptance($id, null);
     }
}
