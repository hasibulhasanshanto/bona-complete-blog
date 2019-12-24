<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function Home(){
        return view('frontend.pages.home');
    }
}
