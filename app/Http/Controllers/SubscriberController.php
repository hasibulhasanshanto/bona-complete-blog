<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Subscriber;

class SubscriberController extends Controller
{
    public function store(Request $request){
        //return $request->all();
        $request->validate([

            'email' => 'required|email|unique:subscribers', 
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = strtolower(trim($request->email)); 
        $subscriber->save();

        
        if( $subscriber){
            Toastr::success('Subscribed Sucessfully!!', 'Success');
            return redirect()->back();

        }else{
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->back();
        } 
        
        
    }
}
