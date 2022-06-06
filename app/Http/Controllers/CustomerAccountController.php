<?php

namespace App\Http\Controllers;

use App\Models\BillingDetails;
use App\Models\CustomerLoginn;
use App\Models\CustomerPasswordReset;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Notification;
use PDF;


class CustomerAccountController extends Controller
{
    function customer_account(){

        $orders = Order::where('user_id',Auth::guard('customer')->id())->get();

        return view('frontend.account',[
            'orders' => $orders,
        ]);
    }

    function customerlogout(Request $request){

        Auth::guard('customer')->logout();

        return redirect()->route('customer.register.from');

    }

    function customer_update(Request $request){

        CustomerLoginn::find(Auth::guard('customer')->id())->update([
            'name' => $request->name,
        ]);

        return back();

    }

    function invoice($invoice_id){

        $billing_info =BillingDetails::where('order_id',$invoice_id)->get();
        $order_info =Order::where('id',$invoice_id)->get();
        $product_info =OrderDetails::where('order_id',$invoice_id)->get();


        $data =[

            'billing_info'=>$billing_info,
            'order_info'=>$order_info,
            'product_info'=>$product_info,



        ];

        // return view('frontend.invoice',$data);
        $pdf = PDF::loadView('frontend.invoice', $data);

        return $pdf->download('valorant.pdf');
        //stream

    }


    //password reset//
    function password_reset_req(){
        return view('customer_password_reset');
    }
 function password_reset_store(Request $request){
    $customer = CustomerLoginn::where('email',$request->email)->firstOrFail();
    $password_reset = CustomerPasswordReset::where('customer_id',$customer->id)->delete();

    CustomerPasswordReset::insert([
        'customer_id'=> $customer->id,
        'token'=> uniqid(),
        'created_at'=> Carbon::now(),
    ]);
    Notification::send($customer, new PasswordResetNotification());
}
}
