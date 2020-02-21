<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //I have changed the route to a user directory
        return view('backend.user.home'); 
    }

    public function fav()
    {

        $posts = Auth::user()->favorite_posts;
        return view('backend.user.favorite', compact('posts'));
    }
}
