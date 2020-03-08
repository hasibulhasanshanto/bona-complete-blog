<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //$tags = Tag::orderBy('id', 'desc')->get();
        $tags = Tag::with('posts')->latest()->get();
        return view('backend.admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.tag.create');
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

            'name' => 'required|unique:tags', 
        ]);
        
        $tag = new Tag();
        $tag->name = strtolower($request->name);
        $tag->slug = Str::slug($request->name); 
        $tag->save(); 
        Toastr::success('Tag Created Sucessfully!', 'Success');

        return redirect()->route('admin.tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::find($id);
        return view('backend.admin.tag.edit', compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required|unique:tags', 
        ]);
        
        $tag = Tag::find($id);
        $tag->name = strtoupper($request->name);
        $tag->slug = Str::slug($request->name); 
        $tag->save(); 

        Toastr::success('Tag Updated Sucessfully!', 'Success');

        return redirect()->route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
        $tag = Tag::find($id)->delete();     

        if( $tag){
            Toastr::success('Tag Deleted Sucessfully!', 'Success');
            return redirect()->route('admin.tag.index');

        }else{
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->route('admin.tag.index');
        }
    }
}
