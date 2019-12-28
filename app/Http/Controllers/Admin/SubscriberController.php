<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Subscriber;

class SubscriberController extends Controller
{
    public function index(){

        $subscribers = Subscriber::latest()->get();
        return view('backend.admin.subscriber', compact('subscribers'));
    }

    public function destroy($subscriber){

        $subscribers = Subscriber::findOrFail($subscriber)->delete();

        if( $subscribers){
            Toastr::success('Subscriber Deleted Sucessfully!', 'Success');
            return redirect()->back();

        }else{
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->back();
        } 

    }

}
