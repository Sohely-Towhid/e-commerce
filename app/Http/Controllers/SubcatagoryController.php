<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Subcatagory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubcatagoryController extends Controller
{
    function index(){
        $catagories= Catagory::all();
        $subcatagories= Subcatagory::all();
        return view('admin.subcatagory.index',[
            'catagories'=>$catagories,
            'subcatagories'=>$subcatagories,
        ]);
    }

    function insert(Request $request){
        Subcatagory::insert([
            'catagory_id'=>$request->catagory_id,
            'subcatagory_name'=>$request->subcatagory_name,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('success','Sub catagory Added');
    }

    function delete($subcatagory_id){
        Subcatagory::find($subcatagory_id)->delete();
        return back();

    }
}
