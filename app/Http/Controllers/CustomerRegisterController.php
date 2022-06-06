<?php

namespace App\Http\Controllers;

// use App\Models\Customerlogin;
use App\Models\CustomerLoginn;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CustomerRegisterController extends Controller
{
    function customer_register(Request $request){

        CustomerLoginn::insert([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'created_at' =>Carbon::now(),

        ]);

        return back();
    }

    function customer_register_from(){
        return view('customer_register');
    }

}
