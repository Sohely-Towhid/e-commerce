<?php

namespace App\Http\Controllers;

use App\Models\CustomerLoginn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    function customer_login(Request $request){
        if(Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])){

            return redirect('/');
        }

        else {
             return redirect('/register');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerLoginn  $customerLoginn
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerLoginn $customerLoginn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerLoginn  $customerLoginn
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerLoginn $customerLoginn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerLoginn  $customerLoginn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerLoginn $customerLoginn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerLoginn  $customerLoginn
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerLoginn $customerLoginn)
    {
        //
    }
}
