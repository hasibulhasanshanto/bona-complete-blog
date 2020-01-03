<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function Home(){

        $categories = Category::all();
        $posts = Post::latest()->take(6)->get();
        return view('frontend.pages.home', compact('categories', 'posts'));
    }
}
