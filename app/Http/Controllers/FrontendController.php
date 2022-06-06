<?php

namespace App\Http\Controllers;

use App\Models\Catagory;
use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

      function index(){

        $all_products = Product::all()->take(6);
        $new_arrival = Product::latest()->take(4)->orderBy('id','DESC')->get();

        $all_catagories = Catagory::all();

        return view('frontend.index',[

            'all_products'=> $all_products,
            'all_catagories'=>$all_catagories,
            'new_arrival' =>  $new_arrival,



        ]);
    }


    function product_details($product_id){

        $product_info = Product::find($product_id);
        $related_product = Product::where('catagory_id',$product_info->catagory_id)->where('id','!=',$product_id)->get();
        $available_colors = Inventory::where('product_id',$product_id)->groupBy('color_id')->selectRaw('sum(color_id) as sum, color_id')->get();


        return view('frontend.product_details',[
            'product_info'=>$product_info,
            'related_product' =>$related_product,
            'available_colors' =>$available_colors,
        ]);

    }


    function getSize(Request $request){

        $available_sizes = Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        $str_to_send = ' <option data-display="- Please select -">Choose A Option</option>';

        foreach($available_sizes as $sizes ){

            $str_to_send .=' <option value="'.$sizes->size_id.'">'.$sizes->rel_to_size->size_name.'</option>';
        }

        echo $str_to_send;
    }
}
