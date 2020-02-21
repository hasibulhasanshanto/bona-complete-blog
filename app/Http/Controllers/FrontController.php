<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function Home(){

        $categories = Category::all();
        $posts = Post::with(['user', 'favorite_to_user'])->latest()->approved()->publish()->take(6)->get();
        return view('frontend.pages.home', compact('categories', 'posts'));
    }

    public function SinglePost($slug){

        //$post = Post::where('slug', $slug)->first();
       $post = Post::with(['user', 'favorite_to_user'])->where('slug', $slug)->approved()->publish()->first();
         
        //Count Blog watch 
        $blogKey = 'blog_'. $post->id;
        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey, 1);
        }

        $randomposts = Post::approved()->publish()->take(3)->inRandomOrder()->get(); 
        return view('frontend.pages.singlepost', compact('post','randomposts'));
    }

    public function AllPost(){
        $posts = Post::with(['user', 'favorite_to_user'])->latest()->approved()->publish()->paginate(12); 
        return view('frontend.pages.posts', compact('posts'));
    }

    public function postByCategory($slug){ 
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->approved()->publish()->get();

       return view('frontend.pages.category_posts', compact('category', 'posts'));

    }

    public function postByTag($slug){
        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts()->approved()->publish()->get(); 
        return view('frontend.pages.tag_posts', compact('tag', 'posts'));
    }
}
