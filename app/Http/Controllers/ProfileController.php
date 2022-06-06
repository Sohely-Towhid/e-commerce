<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;


class ProfileController extends Controller
{
    function profile(){
        return view('admin.profile.profile');
    }

    function name_change(Request $request){

        User::find(Auth::id())->update([
            'name'=>$request->name,

        ]);
        return back()->with('success','Name Changed');

    }

    function password_change(Request $request){
        $request->validate([
            'old_password'=>'required',
            'password'=>['required',Password::min(8)->letters()->mixedCase() ->numbers() ->symbols(),'confirmed'],
            'password_confirmation'=>'required',

        ],[
            'old_password.required'=>'Please give ur old password',
            'password.required'=>'Please give ur new password',
            'password_confirmation.required'=>'give ur new password again',
            'password.confirmed'=>'password does not match',

        ]);

        if(Hash::check($request->old_password,Auth::user()->password)){
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('success','Password Changed');
        }

        else{
            return back()->with('wrong_pass','give ur correct password');
        }
    }

    function photo_change(Request $request){
        $profile_photo=$request->profile_photo;
        if(Auth::user()->profile_photo !='defult.png'){
            $path = public_path('uploads/profile/'.Auth::user()->profile_photo);
            unlink($path);

           $extension=$profile_photo->getClientOriginalExtension();
            $profile_photo_name=Auth::id().'.'.$extension;
            Image::make($profile_photo)->save(public_path('/uploads/profile/'.$profile_photo_name));

            User::find(Auth::id())->update([
                'profile_photo'=> $profile_photo_name,

            ]);

            return back()->with('success','profile photo changed');


        }
        else{

            $extension=$profile_photo->getClientOriginalExtension();
            $profile_photo_name=Auth::id().'.'.$extension;
            Image::make($profile_photo)->save(public_path('/uploads/profile/'.$profile_photo_name));

            User::find(Auth::id())->update([
                'profile_photo'=> $profile_photo_name,

            ]);

            return back()->with('success','profile photo changed');




        }


    }




}
