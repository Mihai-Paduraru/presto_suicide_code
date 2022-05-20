<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth.admin');
    }

    public function index(){
        $users = User::orderBy('updated_at', 'DESC')->get();
        return view('admin.index', compact('users'));
    }

    private function acceptance ($id, $result){
        $user = User::find($id);
        $user->is_revisor = $result;
        $user->save();
        return redirect(route('admin.index'))->with('flash', 'Operazione eseguita');
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
