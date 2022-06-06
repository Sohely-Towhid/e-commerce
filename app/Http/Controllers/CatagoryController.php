<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Subcatagory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Image;
use App\Http\Requests\CatagoryRequest;

class CatagoryController extends Controller
{
    function index(){
        $catagories_count=Catagory::all()->count();
        $catagories= Catagory::all();
        $trash_catagories = Catagory::onlyTrashed()->get();
        return view('admin.catagory.index',[

            'catagories'=>$catagories,
            'trash_catagories'=> $trash_catagories,
            'catagories_count'=> $catagories_count,
        ]);

    }

    function insert(CatagoryRequest $request){


        $catagory_id=Catagory::insertGetId([
            'catagory_name'=>$request->catagory_name,
            'added_by'=>Auth::id(),
            'created_at'=>Carbon::now(),
        ]);
        $catagory_image=$request->catagory_image;
        $extension=$catagory_image->getClientOriginalExtension();
        $catagory_image_name=$catagory_id.'.'.$extension;
        Image::make($catagory_image)->resize(500,300)->save(public_path('uploads/catagory/'.$catagory_image_name));

        Catagory::find($catagory_id)->update([
            'catagory_image'=> $catagory_image_name,
        ]);


        return back()->with('success','catagory added!');



    }

    function delete($catarory_id){

        catagory::find($catarory_id)->delete();
        return back()->with('delete','Catagory Deleted!');
    }

    function edit($catarory_id){
        $Catagory_info=Catagory::find($catarory_id);
        return view('admin.catagory.edit',compact('Catagory_info'));
    }

    function update(Request $request){

        Catagory::find($request->id)->update([
            'catagory_name'=>$request->catagory_name,
            'updated_at'=>Carbon::now(),
        ]);

        $delete_path= public_path('/uploads/catagory/').Catagory::find($request->id)->catagory_image;
        unlink($delete_path);

        $catagory_image=$request->catagory_image;
        $extension=$catagory_image->getClientOriginalExtension();
        $catagory_image_name=$request->id.'.'.$extension;
        Image::make($catagory_image)->resize(500,300)->save(public_path('/uploads/catagory/'.$catagory_image_name));

        Catagory::find($request->id)->update([
            'catagory_image'=> $catagory_image_name,
        ]);
        return redirect('/catagory');
    }

    function restore($catarory_id){
        Catagory::onlyTrashed()->find($catarory_id)->restore();
        return back();

    }

    function force_delete($catagory_id){
       $sub_catagories= Subcatagory::where('catagory_id',$catagory_id)->get();
        foreach($sub_catagories as $sub){
            Subcatagory::find($sub->id)->delete();
        }
        $delete_path= public_path('/uploads/catagory/'.Catagory::onlyTrashed()->find($catagory_id)->catagory_image);
        unlink($delete_path);
        Catagory::onlyTrashed()->find($catagory_id)->forceDelete();
        return back();
    }

    function markdel(Request $request){
        foreach($request->mark as $mark){
            Catagory::find($mark)->delete();
        }
        return back();

    }

}
