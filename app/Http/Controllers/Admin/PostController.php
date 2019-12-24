<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Auth;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('backend.admin.post.index', compact('posts') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('backend.admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required|unique:posts', 
            'image' => 'required|file|mimes:jpeg,png,jpg|max:3050', 
            'categories' => 'required', 
            'tags' => 'required', 
            'body' => 'required', 
        ]);
        
//          Get Image file
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image)){
//          make Unique nam efor image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
 //         Check is category Dir is Exists
            if(!Storage::disk('public')->exists('posts')){

                Storage::disk('public')->makeDirectory('posts');

            }
//          Resize image for category and Upload
                $postimage = Image::make($image)->resize('1600','479')->stream();
                Storage::disk('public')->put('posts/'. $imagename, $postimage);
 //         Check is category Slider Dir is Exists

        } 
        else{
            $imagename = 'default.png';
        }

//      Save all to category
        $posts = new Post();
        $posts->title = Str::title($request->title);
        $posts->user_id = Auth::id();
        $posts->image = $imagename; 
        $posts->slug = $slug;
        $posts->body = $request->body;
        
        if(isset($request->status)){
            $posts->status = true;
        }
        else{
            $posts->status = false;
        }
        $posts->is_approved = true;

        $posts->save();

        $posts->categories()->attach($request->categories);
        $posts->tags()->attach($request->tags);
        
        

        if( $posts){
            Toastr::success('Post Created Sucessfully!!', 'Success');
            return redirect()->route('admin.post.index');

        }else{
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->route('admin.post.index');
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
