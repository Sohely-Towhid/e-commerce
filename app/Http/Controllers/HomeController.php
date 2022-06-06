<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $users=user::where('id','!=',Auth::id())->paginate(4);
        $logged_user=Auth::user()->name;
        $total_user= User::all()->count();
        return view('home',[
            'users'=>$users,
            'logged_user'=> $logged_user,
            'total_user'=> $total_user,

        ]);

    }
    function delete($user_id){
        User::find($user_id)->delete();
        return back();


    }


     //about

    function about(){
        return view('about');
    }

    //contact

    function contact(){
        return view('contact');

    }

    function dashboard(){
        return view('layouts.dashboard');
    }



}
